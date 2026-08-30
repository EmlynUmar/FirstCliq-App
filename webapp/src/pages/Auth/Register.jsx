import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { User, Phone, Mail, MapPin, Lock, Hash, Users, ArrowRight, ArrowLeft, AlertCircle } from 'lucide-react';
import { api } from '../../services/api';
import './Auth.css';

const Register = () => {
  const navigate = useNavigate();
  const [step, setStep] = useState(1);
  const [error, setError] = useState('');
  const [submitting, setSubmitting] = useState(false);

  // Form State
  const [fname, setFname] = useState('');
  const [lname, setLname] = useState('');
  const [phone, setPhone] = useState('');
  const [email, setEmail] = useState('');
  const [state, setState] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [transpin, setTranspin] = useState('');
  const [referal, setReferal] = useState('');

  const handleNext = (e) => {
    e.preventDefault();
    if (!fname || !lname || !phone || !email) {
      setError('Please fill in all fields.');
      return;
    }
    setError('');
    setStep(2);
  };

  const handleRegister = (e) => {
    e.preventDefault();
    if (!state || !password || !confirmPassword || !transpin) {
      setError('Please fill in all fields.');
      return;
    }
    if (password !== confirmPassword) {
      setError('Passwords do not match.');
      return;
    }
    if (password.length < 8) {
      setError('Password must be at least 8 characters long.');
      return;
    }
    if (transpin.length < 4) {
      setError('Transaction PIN must be 4 digits.');
      return;
    }
    setError('');
    setSubmitting(true);

    const formData = {
      fname,
      lname,
      email,
      phone,
      state,
      account: '1', // Default to Subscriber
      password,
      transpin,
      referal
    };

    api.register(formData)
      .then(text => {
        setSubmitting(false);
        try {
          const res = JSON.parse(text);
          if (res.status === 'success') {
            navigate('/');
          } else {
            setError(res.msg || 'Registration failed. Please check your inputs.');
          }
        } catch (err) {
          if (text.includes('success') || text.includes('successful')) {
            navigate('/');
          } else {
            setError(text.replace(/<[^>]*>/g, '') || 'Registration failed. Please check your inputs.');
          }
        }
      })
      .catch(err => {
        console.error(err);
        setError('Connection failed. Please try again.');
        setSubmitting(false);
      });
  };

  return (
    <div className="auth-page">
      <div className="auth-decoration">
        <div className="auth-circle auth-circle--1" />
        <div className="auth-circle auth-circle--2" />
        <div className="auth-circle auth-circle--3" />
      </div>

      <div className="auth-content">
        <div className="auth-brand">
          <img src="Logo1.png" alt="AGDATASUB" className="auth-logo" />
        </div>

        <div className="auth-card">
          <div className="auth-card-header">
            <h1 className="auth-title">Create Account</h1>
            <p className="auth-subtitle">Join thousands of users saving on data & airtime</p>
            
            {/* Step indicator */}
            <div className="step-indicator">
              <div className={`step-dot ${step >= 1 ? 'active' : ''}`} />
              <div className="step-line">
                <div className={`step-line-fill ${step >= 2 ? 'filled' : ''}`} />
              </div>
              <div className={`step-dot ${step >= 2 ? 'active' : ''}`} />
            </div>
          </div>

          <form onSubmit={step === 1 ? handleNext : handleRegister}>
            {error && (
              <div className="auth-error">
                <AlertCircle size={16} />
                <span>{error}</span>
              </div>
            )}

            {step === 1 ? (
              <div className="form-fields" key="step1">
                <div className="field">
                  <label className="field-label">First Name</label>
                  <div className="field-input">
                    <User size={18} className="field-icon" />
                    <input 
                      type="text" 
                      placeholder="Enter first name" 
                      value={fname}
                      onChange={(e) => setFname(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Last Name</label>
                  <div className="field-input">
                    <User size={18} className="field-icon" />
                    <input 
                      type="text" 
                      placeholder="Enter last name" 
                      value={lname}
                      onChange={(e) => setLname(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Phone Number</label>
                  <div className="field-input">
                    <Phone size={18} className="field-icon" />
                    <input 
                      type="number" 
                      placeholder="080 000 0000" 
                      value={phone}
                      onChange={(e) => setPhone(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Email</label>
                  <div className="field-input">
                    <Mail size={18} className="field-icon" />
                    <input 
                      type="email" 
                      placeholder="you@example.com" 
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <button type="submit" className="auth-btn">
                  <span>Continue</span>
                  <ArrowRight size={18} />
                </button>
              </div>
            ) : (
              <div className="form-fields" key="step2">
                <div className="field">
                  <label className="field-label">State</label>
                  <div className="field-input">
                    <MapPin size={18} className="field-icon" />
                    <select 
                      value={state}
                      onChange={(e) => setState(e.target.value)}
                      required
                    >
                      <option value="" disabled>Select your state</option>
                      <option value="Abuja FCT">Abuja FCT</option>
                      <option value="Lagos">Lagos</option>
                      <option value="Kano">Kano</option>
                      <option value="Rivers">Rivers</option>
                      <option value="Oyo">Oyo</option>
                      <option value="Anambra">Anambra</option>
                      <option value="Kaduna">Kaduna</option>
                    </select>
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Password</label>
                  <div className="field-input">
                    <Lock size={18} className="field-icon" />
                    <input 
                      type="password" 
                      placeholder="Min 8 characters" 
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Confirm Password</label>
                  <div className="field-input">
                    <Lock size={18} className="field-icon" />
                    <input 
                      type="password" 
                      placeholder="Re-enter password" 
                      value={confirmPassword}
                      onChange={(e) => setConfirmPassword(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Transaction PIN</label>
                  <div className="field-input">
                    <Hash size={18} className="field-icon" />
                    <input 
                      type="password" 
                      placeholder="4-digit PIN" 
                      maxLength="4" 
                      value={transpin}
                      onChange={(e) => setTranspin(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="field">
                  <label className="field-label">Referral Code <span className="field-optional">(optional)</span></label>
                  <div className="field-input">
                    <Users size={18} className="field-icon" />
                    <input 
                      type="text" 
                      placeholder="Enter referral code" 
                      value={referal}
                      onChange={(e) => setReferal(e.target.value)}
                    />
                  </div>
                </div>

                <div className="form-row">
                  <button type="button" className="auth-btn auth-btn--ghost" onClick={() => setStep(1)} disabled={submitting}>
                    <ArrowLeft size={18} />
                    <span>Back</span>
                  </button>
                  <button type="submit" className="auth-btn" disabled={submitting}>
                    <span>{submitting ? 'Registering...' : 'Register'}</span>
                    <ArrowRight size={18} />
                  </button>
                </div>
              </div>
            )}
          </form>
        </div>

        <p className="auth-footer">
          Already have an account? <Link to="/login" className="auth-link">Sign In</Link>
        </p>
      </div>
    </div>
  );
};

export default Register;
