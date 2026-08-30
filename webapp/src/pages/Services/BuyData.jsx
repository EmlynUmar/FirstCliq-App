import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Info, Shield } from 'lucide-react';
import './ServiceForm.css';

const BuyData = () => {
  const navigate = useNavigate();
  const [networks, setNetworks] = useState([]);
  const [allPlans, setAllPlans] = useState([]);
  const [filteredPlans, setFilteredPlans] = useState([]);
  const [beneficiaries, setBeneficiaries] = useState([]);
  
  const [selectedNetworkId, setSelectedNetworkId] = useState('');
  const [dataType, setDataType] = useState('');
  const [selectedPlanId, setSelectedPlanId] = useState('');
  const [phone, setPhone] = useState('');
  const [amount, setAmount] = useState('');
  const [portedNumber, setPortedNumber] = useState(false);

  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');

  const [pin, setPin] = useState('');
  const [showPinModal, setShowPinModal] = useState(false);

  useEffect(() => {
    api.getPageData('buy-data')
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
        setBeneficiaries(res.data3 || []);
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        setError('Failed to load data plans.');
        setLoading(false);
      });
  }, [navigate]);

  // Filter plans when network or data type changes
  useEffect(() => {
    if (!selectedNetworkId) {
      setFilteredPlans([]);
      setSelectedPlanId('');
      setAmount('');
      return;
    }

    let filtered = allPlans.filter(p => String(p.datanetwork) === String(selectedNetworkId));

    if (dataType) {
      filtered = filtered.filter(p => String(p.datatype).toLowerCase() === dataType.toLowerCase());
    }

    setFilteredPlans(filtered);
    setSelectedPlanId('');
    setAmount('');
  }, [selectedNetworkId, dataType, allPlans]);

  const handlePlanChange = (e) => {
    const planId = e.target.value;
    setSelectedPlanId(planId);
    
    const plan = filteredPlans.find(p => String(p.pId) === String(planId));
    if (plan && profile) {
      let price = plan.userprice;
      const role = String(profile.sType);
      if (role === '2') price = plan.agentprice;
      else if (role === '3') price = plan.vendorprice;
      else if (role === '4') price = plan.apiprice;
      setAmount(price);
    } else {
      setAmount('');
    }
  };

  const handleFormSubmit = (e) => {
    e.preventDefault();
    if (!selectedNetworkId || !selectedPlanId || !phone) {
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
      phone: phone,
      ported_number: portedNumber ? 'on' : 'off',
      dataplan: selectedPlanId,
      transkey: transactionPin,
      transref: `DT-${Date.now()}`
    };

    api.submitAction('buy-data', 'purchase-data', payload)
      .then(res => {
        setSubmitting(false);
        setShowPinModal(false);
        if (res.status === 'redirect') {
          const ref = res.location.split('ref=')[1] || '';
          navigate(`/history?ref=${ref}`);
        } else if (res.msg) {
          if (res.msg.includes('Success') || res.msg.includes('successful')) {
            setSuccessMsg(res.msg.replace(/<[^>]*>/g, ''));
          } else {
            setError(res.msg.replace(/<[^>]*>/g, ''));
          }
        } else {
          setSuccessMsg('Data purchase submitted successfully.');
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
        <Header title="Buy Data" showBack={true} />
        <div className="loading-container">Loading...</div>
      </div>
    );
  }

  // Get data types available for selected network
  const getDataTypesForNetwork = () => {
    if (!selectedNetworkId) return [];
    const selectedNetwork = networks.find(n => String(n.nId) === String(selectedNetworkId));
    if (!selectedNetwork) return [];

    const types = [];
    if (selectedNetwork.smeStatus === 'On') types.push({ value: 'SME', label: 'SME' });
    if (selectedNetwork.sme2Status === 'On') types.push({ value: 'SME2', label: 'SME2' });
    if (selectedNetwork.giftingStatus === 'On') types.push({ value: 'Gifting', label: 'Gifting' });
    if (selectedNetwork.corporateStatus === 'On') types.push({ value: 'Corporate', label: 'Corporate Gifting' });
    if (selectedNetwork.dataflexStatus === 'On') types.push({ value: 'dataflex', label: 'Dataflex' });
    if (selectedNetwork.awoofStatus === 'On') types.push({ value: 'Awoof', label: 'Awoof Data' });
    if (selectedNetwork.shareStatus === 'On') types.push({ value: 'Share', label: 'Data Share' });

    // Fallback if none are explicitly enabled or database is empty, return common ones
    if (types.length === 0) {
      return [
        { value: 'SME', label: 'SME' },
        { value: 'Gifting', label: 'Gifting' },
        { value: 'Corporate', label: 'Corporate Gifting' }
      ];
    }
    return types;
  };

  return (
    <div className="service-page">
      <Header title="Buy Data" showBack={true} />
      
      <div className="service-body">
        {/* Network Selection Pills */}
        <div className="network-pills">
          {networks.filter(n => n.networkStatus === 'On').map(net => {
            let letter = net.network ? net.network.charAt(0).toUpperCase() : 'N';
            let color = '#ccc';
            let textColor = '#000';
            if (net.network.toLowerCase().includes('mtn')) { color = '#FFCB05'; textColor = '#000'; }
            else if (net.network.toLowerCase().includes('airtel')) { color = '#FF0000'; textColor = '#fff'; }
            else if (net.network.toLowerCase().includes('glo')) { color = '#50B651'; textColor = '#fff'; }
            else if (net.network.toLowerCase().includes('9mobile')) { color = '#006848'; textColor = '#fff'; }

            return (
              <button
                key={net.nId}
                type="button"
                className={`network-pill ${String(selectedNetworkId) === String(net.nId) ? 'active' : ''}`}
                onClick={() => setSelectedNetworkId(net.nId)}
              >
                <div className="network-pill-avatar" style={{ background: color, color: textColor }}>
                  {letter}
                </div>
                <span className="network-pill-name">{net.network}</span>
              </button>
            );
          })}
        </div>

        <div className="info-banner">
          <Info size={16} />
          <span>SME Data check: <strong>*461*4#</strong> | Airtel: <strong>*140#</strong></span>
        </div>

        <form onSubmit={handleFormSubmit} className="form-card">
          {error && <div className="error-message">{error}</div>}
          {successMsg && <div className="success-message">{successMsg}</div>}

          <div className="form-field">
            <label className="form-label">Network</label>
            <div className="form-select-wrap">
              <select 
                value={selectedNetworkId} 
                onChange={(e) => setSelectedNetworkId(e.target.value)} 
                required
              >
                <option value="">Select Network</option>
                {networks.filter(n => n.networkStatus === 'On').map(n => (
                  <option key={n.nId} value={n.nId}>{n.network}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Data Type</label>
            <div className="form-select-wrap">
              <select 
                value={dataType} 
                onChange={(e) => setDataType(e.target.value)} 
                disabled={!selectedNetworkId}
                required
              >
                <option value="">Select Data Type</option>
                {getDataTypesForNetwork().map(t => (
                  <option key={t.value} value={t.value}>{t.label}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Data Plan</label>
            <div className="form-select-wrap">
              <select 
                value={selectedPlanId} 
                onChange={handlePlanChange} 
                disabled={!dataType}
                required
              >
                <option value="">Select Plan</option>
                {filteredPlans.map(p => (
                  <option key={p.pId} value={p.pId}>{p.name} — {p.duration} — ₦{p.userprice}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Beneficiary</label>
            <div className="form-select-wrap">
              <select 
                onChange={(e) => {
                  if (e.target.value) setPhone(e.target.value);
                }}
              >
                <option value="">Choose from Beneficiary</option>
                {beneficiaries.map((b, idx) => (
                  <option key={idx} value={b.phone}>{b.name} ({b.phone})</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Phone Number</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter phone number" 
                value={phone} 
                onChange={(e) => setPhone(e.target.value)} 
                required 
              />
            </div>
          </div>

          <div className="form-summary">
            <div className="form-summary-row">
              <span>Amount to Pay</span>
              <span className="form-summary-value">{amount ? `₦${amount}` : '₦0.00'}</span>
            </div>
          </div>

          <div className="form-checkbox-wrap">
            <input 
              type="checkbox" 
              id="ported_number" 
              checked={portedNumber} 
              onChange={(e) => setPortedNumber(e.target.checked)} 
            />
            <label htmlFor="ported_number">Disable Number Validator (Ported Number)</label>
          </div>

          <button type="submit" className="form-submit-btn" disabled={submitting}>
            {submitting ? 'Processing...' : 'Buy Data'}
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

export default BuyData;
