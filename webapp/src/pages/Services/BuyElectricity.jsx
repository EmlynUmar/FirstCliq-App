import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Info, Shield } from 'lucide-react';
import './ServiceForm.css';

const BuyElectricity = () => {
  const navigate = useNavigate();
  const [providers, setProviders] = useState([]);
  
  const [selectedProviderId, setSelectedProviderId] = useState('');
  const [meterType, setMeterType] = useState('');
  const [phone, setPhone] = useState('');
  const [meterNumber, setMeterNumber] = useState('');
  const [amount, setAmount] = useState('');
  
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');
  
  const [pin, setPin] = useState('');
  const [showPinModal, setShowPinModal] = useState(false);

  useEffect(() => {
    api.getPageData('electricity')
      .then(res => {
        if (res.status === 'fail' || !res.profileDetails) {
          navigate('/login');
          return;
        }
        setProfile(res.profileDetails);
        setProviders(res.data || []);
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        setError('Failed to load electricity providers.');
        setLoading(false);
      });
  }, [navigate]);

  const handleFormSubmit = (e) => {
    e.preventDefault();
    if (!selectedProviderId || !meterType || !phone || !meterNumber || !amount) {
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
    
    const selectedProvider = providers.find(p => String(p.eId) === String(selectedProviderId));
    
    const payload = {
      provider: selectedProviderId,
      metertype: meterType,
      phone: phone,
      meternumber: meterNumber,
      amount: amount,
      transkey: transactionPin,
      transref: `EL-${Date.now()}`
    };

    api.submitAction('electricity', 'purchase-electricity', payload)
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
          setSuccessMsg('Electricity token purchase submitted successfully.');
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
        <Header title="Electricity Bill" showBack={true} />
        <div className="loading-container">Loading...</div>
      </div>
    );
  }

  return (
    <div className="service-page">
      <Header title="Electricity Bill" showBack={true} />
      
      <div className="service-body">
        <div className="info-banner">
          <Info size={18} />
          <p>Please double check the meter number and amount before submitting.</p>
        </div>

        <form onSubmit={handleFormSubmit} className="form-card">
          {error && <div className="error-message">{error}</div>}
          {successMsg && <div className="success-message">{successMsg}</div>}

          <div className="form-field">
            <label className="form-label">Provider</label>
            <div className="form-select-wrap">
              <select value={selectedProviderId} onChange={(e) => setSelectedProviderId(e.target.value)} required>
                <option value="">Select Provider</option>
                {providers.map(p => (
                  <option key={p.eId} value={p.eId}>{p.provider}</option>
                ))}
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Meter Type</label>
            <div className="form-select-wrap">
              <select value={meterType} onChange={(e) => setMeterType(e.target.value)} required>
                <option value="">Select Meter Type</option>
                <option value="prepaid">Prepaid</option>
                <option value="postpaid">Postpaid</option>
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Meter Number</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter Meter Number" 
                value={meterNumber} 
                onChange={(e) => setMeterNumber(e.target.value)} 
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
            <label className="form-label">Amount (₦)</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter Amount" 
                value={amount} 
                onChange={(e) => setAmount(e.target.value)} 
                required 
              />
            </div>
          </div>

          <button type="submit" className="form-submit-btn" disabled={submitting}>
            {submitting ? 'Processing...' : 'Pay Bill'}
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

export default BuyElectricity;
