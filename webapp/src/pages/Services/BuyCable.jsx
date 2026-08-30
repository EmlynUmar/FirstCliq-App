import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Info, Shield } from 'lucide-react';
import './ServiceForm.css';

const BuyCable = () => {
  const navigate = useNavigate();
  const [providers, setProviders] = useState([]);
  const [allPlans, setAllPlans] = useState([]);
  const [filteredPlans, setFilteredPlans] = useState([]);
  
  const [selectedProviderId, setSelectedProviderId] = useState('');
  const [selectedPlanId, setSelectedPlanId] = useState('');
  const [subType, setSubType] = useState('');
  const [phone, setPhone] = useState('');
  const [iucNumber, setIucNumber] = useState('');
  const [amount, setAmount] = useState('');
  
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');
  
  const [pin, setPin] = useState('');
  const [showPinModal, setShowPinModal] = useState(false);

  useEffect(() => {
    api.getPageData('cable-tv')
      .then(res => {
        if (res.status === 'fail' || !res.profileDetails) {
          navigate('/login');
          return;
        }
        setProfile(res.profileDetails);
        setProviders(res.data || []);
        
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
        setError('Failed to load cable providers.');
        setLoading(false);
      });
  }, [navigate]);

  const handleProviderChange = (e) => {
    const provId = e.target.value;
    setSelectedProviderId(provId);
    setSelectedPlanId('');
    setAmount('');
    
    const filtered = allPlans.filter(p => String(p.cableprovider) === String(provId));
    setFilteredPlans(filtered);
  };

  const handlePlanChange = (e) => {
    const planId = e.target.value;
    setSelectedPlanId(planId);
    
    const plan = filteredPlans.find(p => String(p.cpId) === String(planId));
    if (plan && profile) {
      let price = plan.userprice;
      if (profile.sType === '2' || profile.sType === 2) price = plan.agentprice;
      else if (profile.sType === '3' || profile.sType === 3) price = plan.vendorprice;
      else if (profile.sType === '4' || profile.sType === 4) price = plan.apiprice;
      setAmount(price);
    } else {
      setAmount('');
    }
  };

  const handleFormSubmit = (e) => {
    e.preventDefault();
    if (!selectedProviderId || !selectedPlanId || !subType || !phone || !iucNumber) {
      setError('Please fill in all fields.');
      return;
    }
    setError('');
    
    // Show PIN validation modal if required
    if (profile && profile.sPinStatus === '0') {
      setShowPinModal(true);
    } else {
      executePurchase('0000');
    }
  };

  const executePurchase = (transactionPin) => {
    setSubmitting(true);
    setError('');
    
    const selectedPlan = filteredPlans.find(p => String(p.cpId) === String(selectedPlanId));
    const selectedProvider = providers.find(p => String(p.cId) === String(selectedProviderId));
    
    const payload = {
      provider: selectedProviderId,
      cableplan: selectedPlanId,
      cabledetails: selectedPlan ? `${selectedPlan.name} ${selectedPlan.type}` : '',
      amounttopay: amount,
      subtype: subType,
      phone: phone,
      iucnumber: iucNumber,
      transkey: transactionPin,
      transref: `CB-${Date.now()}`
    };

    api.submitAction('cable-tv', 'purchase-cable-sub', payload)
      .then(res => {
        setSubmitting(false);
        setShowPinModal(false);
        if (res.status === 'redirect') {
          // Redirected to transaction details
          const ref = res.location.split('ref=')[1] || '';
          navigate(`/history?ref=${ref}`);
        } else if (res.msg) {
          if (res.msg.includes('Success') || res.msg.includes('successful')) {
            setSuccessMsg(res.msg);
          } else {
            setError(res.msg);
          }
        } else {
          setSuccessMsg('Cable subscription submitted successfully.');
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
        <Header title="Cable TV" showBack={true} />
        <div className="loading-container">Loading...</div>
      </div>
    );
  }

  return (
    <div className="service-page">
      <Header title="Cable TV" showBack={true} />
      
      <div className="service-body">
        <div className="info-banner">
          <Info size={18} />
          <p>Double check IUC number before proceeding. StarTimes customer care: 094618888.</p>
        </div>

        <form onSubmit={handleFormSubmit} className="form-card">
          {error && <div className="error-message">{error}</div>}
          {successMsg && <div className="success-message">{successMsg}</div>}

          <div className="form-field">
            <label className="form-label">Provider</label>
            <div className="form-select-wrap">
              <select value={selectedProviderId} onChange={handleProviderChange} required>
                <option value="">Select Provider</option>
                {providers.map(p => (
                  <option key={p.cId} value={p.cId}>{p.provider}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Plan</label>
            <div className="form-select-wrap">
              <select value={selectedPlanId} onChange={handlePlanChange} disabled={!selectedProviderId} required>
                <option value="">Select Plan</option>
                {filteredPlans.map(p => (
                  <option key={p.cpId} value={p.cpId}>{p.name} - ₦{p.userprice}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Subscription Type</label>
            <div className="form-select-wrap">
              <select value={subType} onChange={(e) => setSubType(e.target.value)} required>
                <option value="">Select Type</option>
                <option value="change">Change</option>
                <option value="renew">Renew</option>
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">IUC Number</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter IUC / SmartCard Number" 
                value={iucNumber} 
                onChange={(e) => setIucNumber(e.target.value)} 
                required 
              />
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Customer Phone Number</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter Customer Phone" 
                value={phone} 
                onChange={(e) => setPhone(e.target.value)} 
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
            {submitting ? 'Processing...' : 'Subscribe'}
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

export default BuyCable;
