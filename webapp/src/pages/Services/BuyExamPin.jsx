import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Info, Shield } from 'lucide-react';
import './ServiceForm.css';

const BuyExamPin = () => {
  const navigate = useNavigate();
  const [providers, setProviders] = useState([]);
  
  const [selectedProviderId, setSelectedProviderId] = useState('');
  const [noOfPin, setNoOfPin] = useState(1);
  const [phone, setPhone] = useState('');
  const [amount, setAmount] = useState('');
  
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');
  
  const [pin, setPin] = useState('');
  const [showPinModal, setShowPinModal] = useState(false);

  useEffect(() => {
    api.getPageData('exam-pins')
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
        setError('Failed to load exam providers.');
        setLoading(false);
      });
  }, [navigate]);

  useEffect(() => {
    const provider = providers.find(p => String(p.eId) === String(selectedProviderId));
    if (provider) {
      setAmount(provider.price * noOfPin);
    } else {
      setAmount('');
    }
  }, [selectedProviderId, noOfPin, providers]);

  const handleFormSubmit = (e) => {
    e.preventDefault();
    if (!selectedProviderId || !noOfPin || !phone) {
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
      provider: selectedProviderId,
      no_of_pin: noOfPin,
      phone: phone,
      amounttopay: amount,
      transkey: transactionPin,
      transref: `EX-${Date.now()}`
    };

    api.submitAction('exam-pins', 'purchase-exam-pin', payload)
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
          setSuccessMsg('Exam pin purchase submitted successfully.');
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
        <Header title="Exam Pins" showBack={true} />
        <div className="loading-container">Loading...</div>
      </div>
    );
  }

  return (
    <div className="service-page">
      <Header title="Exam Pins" showBack={true} />
      
      <div className="service-body">
        <div className="info-banner">
          <Info size={18} />
          <p>Tokens will be sent to the phone number and saved in transaction history.</p>
        </div>

        <form onSubmit={handleFormSubmit} className="form-card">
          {error && <div className="error-message">{error}</div>}
          {successMsg && <div className="success-message">{successMsg}</div>}

          <div className="form-field">
            <label className="form-label">Exam Provider</label>
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
            <label className="form-label">Quantity (No. of Pins)</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                min="1" 
                max="5"
                placeholder="Number of Pins" 
                value={noOfPin} 
                onChange={(e) => setNoOfPin(parseInt(e.target.value) || 1)} 
                required 
              />
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Phone Number (to receive token)</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter Phone Number" 
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
            {submitting ? 'Processing...' : 'Buy Exam Pin'}
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

export default BuyExamPin;
