import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import { Info, Shield } from 'lucide-react';
import './ServiceForm.css';

const BuyAirtime = () => {
  const navigate = useNavigate();
  const [networks, setNetworks] = useState([]);
  const [discounts, setDiscounts] = useState([]);
  const [beneficiaries, setBeneficiaries] = useState([]);
  
  const [selectedNetworkId, setSelectedNetworkId] = useState('');
  const [networkType, setNetworkType] = useState('VTU');
  const [phone, setPhone] = useState('');
  const [amount, setAmount] = useState('');
  const [amountToPay, setAmountToPay] = useState(0);
  const [discountVal, setDiscountVal] = useState('0%');
  const [portedNumber, setPortedNumber] = useState(false);

  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');
  const [successMsg, setSuccessMsg] = useState('');

  const [pin, setPin] = useState('');
  const [showPinModal, setShowPinModal] = useState(false);

  useEffect(() => {
    api.getPageData('buy-airtime')
      .then(res => {
        if (res.status === 'fail' || !res.profileDetails) {
          navigate('/login');
          return;
        }
        setProfile(res.profileDetails);
        setNetworks(res.data || []);
        
        let fetchedDiscounts = [];
        if (res.data2) {
          try {
            fetchedDiscounts = typeof res.data2 === 'string' ? JSON.parse(res.data2) : res.data2;
          } catch (e) {
            console.error('Error parsing discounts:', e);
          }
        }
        setDiscounts(fetchedDiscounts);
        setBeneficiaries(res.data3 || []);
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        setError('Failed to load networks.');
        setLoading(false);
      });
  }, [navigate]);

  useEffect(() => {
    if (!selectedNetworkId || !amount) {
      setAmountToPay(0);
      setDiscountVal('0%');
      return;
    }

    const amt = parseFloat(amount);
    if (isNaN(amt)) {
      setAmountToPay(0);
      setDiscountVal('0%');
      return;
    }

    // Find discount for chosen network and sType
    const selectedNetwork = networks.find(n => String(n.nId) === String(selectedNetworkId));
    if (!selectedNetwork || !profile) return;

    const discountObj = discounts.find(d => String(d.aNetwork) === String(selectedNetwork.nId));
    let discountPercent = 0;

    if (discountObj) {
      const role = String(profile.sType);
      if (role === '2') discountPercent = parseFloat(discountObj.agentRec || 0);
      else if (role === '3') discountPercent = parseFloat(discountObj.vendorRec || 0);
      else if (role === '4') discountPercent = parseFloat(discountObj.apiRec || 0);
      else discountPercent = parseFloat(discountObj.userRec || 0);
    }

    const calculatedPay = amt - (amt * (discountPercent / 100));
    setAmountToPay(calculatedPay);
    setDiscountVal(`${discountPercent}%`);
  }, [selectedNetworkId, amount, discounts, networks, profile]);

  const handleFormSubmit = (e) => {
    e.preventDefault();
    if (!selectedNetworkId || !phone || !amount) {
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
      amount: amount,
      phone: phone,
      ported_number: portedNumber ? 'on' : 'off',
      networktype: networkType,
      transkey: transactionPin,
      transref: `AR-${Date.now()}`
    };

    api.submitAction('buy-airtime', 'purchase-airtime', payload)
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
          setSuccessMsg('Airtime purchase submitted successfully.');
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
        <Header title="Buy Airtime" showBack={true} />
        <div className="loading-container">Loading...</div>
      </div>
    );
  }

  return (
    <div className="service-page">
      <Header title="Buy Airtime" showBack={true} />
      
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
          <span>Balance check code: <strong>*310#</strong></span>
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
            <label className="form-label">Airtime Type</label>
            <div className="form-select-wrap">
              <select 
                value={networkType} 
                onChange={(e) => setNetworkType(e.target.value)} 
                required
              >
                <option value="VTU">VTU (Instant Top-up)</option>
                <option value="Share And Sell">Share And Sell</option>
                <option value="Momo">Momo Airtime</option>
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

          <div className="form-field">
            <label className="form-label">Amount (₦)</label>
            <div className="form-input-wrap">
              <input 
                type="number" 
                placeholder="0.00" 
                value={amount} 
                onChange={(e) => setAmount(e.target.value)} 
                required 
              />
            </div>
          </div>

          <div className="form-summary">
            <div className="form-summary-row">
              <span>Amount to Pay</span>
              <span className="form-summary-value">₦{amountToPay.toFixed(2)}</span>
            </div>
            <div className="form-summary-row">
              <span>Discount Applied</span>
              <span className="form-summary-value form-summary-value--green">{discountVal}</span>
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
            {submitting ? 'Processing...' : 'Buy Airtime'}
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

export default BuyAirtime;
