import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Shield, Info } from 'lucide-react';
import './ServiceForm.css';

const VerifyNIN = () => {
  const navigate = useNavigate();
  const [network, setNetwork] = useState('');
  const [phone, setPhone] = useState(''); // NIN Number
  const [payable, setPayable] = useState(0);
  const [pin, setPin] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [result, setResult] = useState(null);

  const prices = {
    regular: 200,
    standard: 200,
    premium: 250
  };

  useEffect(() => {
    if (network && prices[network]) {
      setPayable(prices[network]);
    } else {
      setPayable(0);
    }
  }, [network]);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!network) {
      setError('Please select a slip design.');
      return;
    }
    if (!phone || phone.length < 10) {
      setError('Please enter a valid NIN number.');
      return;
    }
    if (!pin || pin.length < 4) {
      setError('Please enter your 4-digit transaction PIN.');
      return;
    }
    setError('');
    setSubmitting(true);
    setResult(null);

    api.submitAction('verify-nin', 'verify-nin', {
      network,
      phone,
      payable: `₦${payable}`,
      transkey: pin,
      transref: `NIN-${Date.now()}`
    })
      .then(res => {
        setSubmitting(false);
        if (res.msg && (res.msg.includes('Error') || res.msg.includes('error') || res.msg.includes('fail'))) {
          setError(res.msg.replace(/<[^>]*>/g, ''));
        } else if (res.msg) {
          setResult(res.msg.replace(/<[^>]*>/g, ''));
        } else if (res.data) {
          setResult(JSON.stringify(res.data, null, 2));
        } else {
          setResult('NIN Verification submitted successfully.');
        }
      })
      .catch(err => {
        console.error(err);
        setError('Verification failed. Please try again.');
        setSubmitting(false);
      });
  };

  return (
    <div className="service-page">
      <Header title="Verify NIN" showBack={true} />
      
      <div className="service-body">
        <div className="info-banner">
          <Info size={18} />
          <p>Verify and generate your NIN Slip. Please make sure you have sufficient funds in your wallet.</p>
        </div>

        <form onSubmit={handleSubmit} className="form-card">
          {error && <div className="error-message">{error}</div>}
          {result && <div className="success-message">{result}</div>}

          <div className="form-field">
            <label className="form-label">Slip Design</label>
            <div className="form-input-wrap">
              <select 
                value={network} 
                onChange={(e) => setNetwork(e.target.value)}
                required
              >
                <option value="" disabled>Select Slip Design</option>
                <option value="regular">Regular Slip - ₦200</option>
                <option value="standard">Standard Slip - ₦200</option>
                <option value="premium">Premium Slip - ₦250</option>
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">NIN Number</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter NIN" 
                value={phone} 
                onChange={(e) => setPhone(e.target.value)} 
                required 
              />
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Amount to Pay</label>
            <div className="form-input-wrap">
              <input 
                type="text" 
                value={`₦${payable}`} 
                readOnly 
                disabled 
              />
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">Transaction PIN</label>
            <div className="form-input-wrap">
              <input 
                type="password" 
                placeholder="Enter 4-digit PIN" 
                value={pin} 
                onChange={(e) => setPin(e.target.value)} 
                maxLength="4"
                required 
              />
            </div>
          </div>

          <button type="submit" className="form-submit-btn" disabled={submitting}>
            {submitting ? 'Verifying...' : 'Verify NIN'}
          </button>
        </form>
      </div>
    </div>
  );
};

export default VerifyNIN;
