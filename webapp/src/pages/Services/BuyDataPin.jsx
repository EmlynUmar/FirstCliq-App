import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Info, Shield } from 'lucide-react';
import './ServiceForm.css';

const BuyDataPin = () => {
  const navigate = useNavigate();
  const [networks, setNetworks] = useState([]);
  const [allPlans, setAllPlans] = useState([]);
  const [filteredPlans, setFilteredPlans] = useState([]);
  
  const [selectedNetworkId, setSelectedNetworkId] = useState('');
  const [selectedPlanId, setSelectedPlanId] = useState('');
  const [quantity, setQuantity] = useState(1);
  const [cardName, setCardName] = useState('');
  const [amount, setAmount] = useState('');
  
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');
  
  const [pin, setPin] = useState('');
  const [showPinModal, setShowPinModal] = useState(false);

  useEffect(() => {
    api.getPageData('buy-data-pin')
      .then(res => {
        if (res.status === 'fail' || !res.profileDetails) {
          navigate('/login');
          return;
        }
        setProfile(res.profileDetails);
        setNetworks(res.data || []);
        
        let plans = [];
        if (res.data2) {
          try {
            plans = typeof res.data2 === 'string' ? JSON.parse(res.data2) : res.data2;
          } catch (e) {
            console.error('Error parsing plans:', e);
          }
        }
        setAllPlans(plans);
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        setError('Failed to load networks and plans.');
        setLoading(false);
      });
  }, [navigate]);

  const handleNetworkChange = (e) => {
    const netId = e.target.value;
    setSelectedNetworkId(netId);
    setSelectedPlanId('');
    setAmount('');
    
    const filtered = allPlans.filter(p => String(p.datanetwork) === String(netId));
    setFilteredPlans(filtered);
  };

  const handlePlanChange = (e) => {
    const planId = e.target.value;
    setSelectedPlanId(planId);
    
    calculatePrice(planId, quantity);
  };

  const handleQuantityChange = (e) => {
    const qty = parseInt(e.target.value) || 1;
    setQuantity(qty);
    calculatePrice(selectedPlanId, qty);
  };

  const calculatePrice = (planId, qty) => {
    const plan = filteredPlans.find(p => String(p.dpId) === String(planId));
    if (plan && profile) {
      let price = plan.userprice;
      if (profile.sType === '2' || profile.sType === 2) price = plan.agentprice;
      else if (profile.sType === '3' || profile.sType === 3) price = plan.vendorprice;
      else if (profile.sType === '4' || profile.sType === 4) price = plan.apiprice;
      setAmount(parseFloat(price) * qty);
    } else {
      setAmount('');
    }
  };

  const handleFormSubmit = (e) => {
    e.preventDefault();
    if (!selectedNetworkId || !selectedPlanId || !quantity || !cardName) {
      setError('Please fill in all fields.');
      return;
    }
    setError('');
    
    if (profile && profile.sPinStatus === '0') {
      setShowPinModal(true);
    } else {
      executePurchase('0000');
    }
  };

  const executePurchase = (transactionPin) => {
    setSubmitting(true);
    setError('');
    
    const payload = {
      network: selectedNetworkId,
      dataplan: selectedPlanId,
      quantity: quantity,
      name: cardName,
      amounttopay: amount,
      transkey: transactionPin,
      transref: `DP-${Date.now()}`
    };

    api.submitAction('buy-data-pin', 'purchase-datapin', payload)
      .then(res => {
        setSubmitting(false);
        setShowPinModal(false);
        if (res.status === 'redirect') {
          const ref = res.location.split('ref=')[1] || '';
          navigate(`/history?ref=${ref}`);
        } else if (res.msg) {
          if (res.msg.includes('Success') || res.msg.includes('successful')) {
            setSuccessMsg(res.msg);
          } else {
            setError(res.msg);
          }
        } else {
          setSuccessMsg('Data Pin order submitted successfully.');
        }
      })
      .catch(err => {
        console.error(err);
        setError('Transaction failed. Please try again.');
        setSubmitting(false);
        setShowPinModal(false);
      });
  };

  if (loading) {
    return (
      <div className="service-page">
        <Header title="Data Pin" showBack={true} />
        <div className="loading-container">Loading...</div>
      </div>
    );
  }

  return (
    <div className="service-page">
      <Header title="Data Pin" showBack={true} />
      
      <div className="service-body">
        <div className="info-banner">
          <Info size={18} />
          <p>Generate data pins and print them out. Compatible with all devices.</p>
        </div>

        <form onSubmit={handleFormSubmit} className="form-card">
          {error && <div className="error-message">{error}</div>}
          {successMsg && <div className="success-message">{successMsg}</div>}

          <div className="form-field">
            <label className="form-label">Network</label>
            <div className="form-select-wrap">
              <select value={selectedNetworkId} onChange={handleNetworkChange} required>
                <option value="">Select Network</option>
                {networks.map(n => (
                  <option key={n.nId} value={n.nId}>{n.network}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Plan</label>
            <div className="form-select-wrap">
              <select value={selectedPlanId} onChange={handlePlanChange} disabled={!selectedNetworkId} required>
                <option value="">Select Plan</option>
                {filteredPlans.map(p => (
                  <option key={p.dpId} value={p.dpId}>{p.name} - ₦{p.userprice}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Quantity</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                min="1" 
                max="10"
                placeholder="Number of Pins" 
                value={quantity} 
                onChange={handleQuantityChange} 
                required 
              />
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Card Business Name (written on pin)</label>
            <div className="form-input-wrap">
              <input 
                type="text" 
                placeholder="Enter Business Name" 
                value={cardName} 
                onChange={(e) => setCardName(e.target.value)} 
                required 
              />
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Amount to Pay</label>
            <div className="form-input-wrap">
              <input type="text" value={amount ? `₦${amount}` : ''} placeholder="Amount to Pay" readOnly />
            </div>
          </div>

          <button type="submit" className="form-submit-btn" disabled={submitting}>
            {submitting ? 'Processing...' : 'Generate Data Pin'}
          </button>
        </form>
      </div>

      {showPinModal && (
        <div className="modal-overlay">
          <div className="modal-content">
            <div className="modal-header">
              <Shield size={24} className="color-highlight" />
              <h3>Enter Transaction PIN</h3>
            </div>
            <p>Please enter your 4-digit security PIN to complete the transaction.</p>
            <div className="form-input-wrap mb-4">
              <input 
                type="password" 
                maxLength="4" 
                placeholder="••••" 
                value={pin} 
                onChange={(e) => setPin(e.target.value)} 
                autoFocus 
              />
            </div>
            <div className="modal-actions">
              <button className="btn-cancel" onClick={() => setShowPinModal(false)}>Cancel</button>
              <button className="btn-confirm" onClick={() => executePurchase(pin)}>Confirm</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default BuyDataPin;
