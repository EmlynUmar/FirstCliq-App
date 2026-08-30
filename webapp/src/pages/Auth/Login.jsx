import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { Phone, Lock, ArrowRight, AlertCircle } from 'lucide-react';
import { api } from '../../services/api';
import './Auth.css';

const Login = () => {
  const navigate = useNavigate();
  const [phone, setPhone] = useState('');
  const [password, setPassword] = useState('');
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState('');

  const handleLogin = (e) => {
    e.preventDefault();
    if (!phone || !password) {
      setError('Please enter both phone number and password.');
      return;
    }
    setError('');
    setSubmitting(true);

    api.login(phone, password)
      .then(text => {
        setSubmitting(false);
        try {
          const res = JSON.parse(text);
          if (res.status === 'success') {
            navigate('/');
          } else {
            setError(res.msg || 'Login failed. Please check your credentials.');
          }
        } catch (err) {
          // If response is not JSON, check if it contains success
          if (text.includes('success') || text.includes('Login successful') || text.includes('Redirecting')) {
            navigate('/');
          } else {
            setError(text.replace(/<[^>]*>/g, '') || 'Login failed. Please check your credentials.');
          }
        }
      })
      .catch(err => {
        console.error(err);
        setError('Connection failed. Please check if your server is running.');
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
            <h1 className="auth-title">Welcome Back</h1>
            <p className="auth-subtitle">Sign in to continue to your account</p>
          </div>

          <form onSubmit={handleLogin}>
            {error && (
              <div className="auth-error">
                <AlertCircle size={16} />
                <span>{error}</span>
              </div>
            )}

            <div className="form-fields">
              <div className="field">
                <label className="field-label">Phone Number</label>
                <div className="field-input">
                  <Phone size={18} className="field-icon" />
                  <input 
                    type="number" 
                    placeholder="Enter phone number" 
                    value={phone}
                    onChange={(e) => setPhone(e.target.value)}
                    required 
                  />
                </div>
              </div>

              <div className="field">
                <label className="field-label">Password</label>
                <div className="field-input">
                  <Lock size={18} className="field-icon" />
                  <input 
                    type="password" 
                    placeholder="Enter password" 
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required 
                  />
                </div>
              </div>

              <button type="submit" className="auth-btn" disabled={submitting}>
                <span>{submitting ? 'Signing In...' : 'Sign In'}</span>
                <ArrowRight size={18} />
              </button>
            </div>
          </form>
        </div>

        <p className="auth-footer">
          Don't have an account? <Link to="/register" className="auth-link">Create Account</Link>
        </p>
      </div>
    </div>
  );
};

export default Login;
