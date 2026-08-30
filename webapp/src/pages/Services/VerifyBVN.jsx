import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Shield, Info } from 'lucide-react';
import './ServiceForm.css';

const VerifyBVN = () => {
  const navigate = useNavigate();
  const [network, setNetwork] = useState('regular');
  const [phone, setPhone] = useState(''); // BVN Number
  const [payable, setPayable] = useState(150);
  const [pin, setPin] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [result, setResult] = useState(null);

  const handleSubmit = (e) => {
    e.preventDefault();
    if (!phone || phone.length < 11) {
      setError('Please enter a valid 11-digit BVN.');
      return;
    }
    if (!pin || pin.length < 4) {
      setError('Please enter your 4-digit transaction PIN.');
      return;
    }
    setError('');
    setSubmitting(true);
    setResult(null);

    api.submitAction('verify-bvn', 'verify-bvn', {
      network,
      phone,
      payable: `₦${payable}`,
      transkey: pin,
      transref: `BVN-${Date.now()}`
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
          setResult('BVN Verification submitted successfully.');
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
      <Header title="Verify BVN" showBack={true} />
      
      <div className="service-body">
        <div className="info-banner">
          <Info size={18} />
          <p>Verify and generate your BVN Info Slip. A fee of ₦150 applies. Please make sure you have sufficient funds in your wallet.</p>
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
                <option value="regular">Information Slip - ₦150</option>
              </select>
            </div>
          </div>

          <div className="form-field">
            <label className="form-label">BVN Number</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="Enter 11-digit BVN" 
                value={phone} 
                onChange={(e) => setPhone(e.target.value)} 
                maxLength="11"
                required 
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
            {submitting ? 'Verifying...' : 'Verify BVN'}
          </button>
        </form>
      </div>
    </div>
  );
};

export default VerifyBVN;
