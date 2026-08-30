import Header from '../../components/Header/Header';
import { useState, useEffect } from 'react';
import { Shield, Lock, ChevronRight, User, Phone, Mail, MapPin, AlertCircle, LogOut } from 'lucide-react';
import { api } from '../../services/api';
import { useNavigate } from 'react-router-dom';
import './Settings.css';

const Settings = () => {
  const navigate = useNavigate();
  const [activeTab, setActiveTab] = useState('profile');
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);

  // Password state
  const [oldpass, setOldpass] = useState('');
  const [newpass, setNewpass] = useState('');
  const [confirmPass, setConfirmPass] = useState('');
  const [passError, setPassError] = useState('');
  const [passSuccess, setPassSuccess] = useState('');
  const [passSubmitting, setPassSubmitting] = useState(false);

  // PIN state
  const [oldpin, setOldpin] = useState('');
  const [newpin, setNewpin] = useState('');
  const [confirmPinVal, setConfirmPinVal] = useState('');
  const [pinError, setPinError] = useState('');
  const [pinSuccess, setPinSuccess] = useState('');
  const [pinSubmitting, setPinSubmitting] = useState(false);

  // Disable/Enable PIN state
  const [disableOldPin, setDisableOldPin] = useState('');
  const [pinStatusSelect, setPinStatusSelect] = useState('0'); // '0' is enable, '1' is disable
  const [statusError, setStatusError] = useState('');
  const [statusSuccess, setStatusSuccess] = useState('');
  const [statusSubmitting, setStatusSubmitting] = useState(false);

  useEffect(() => {
    api.getPageData('profile')
      .then(res => {
        if (res.status === 'fail' || !res.profileDetails) {
          navigate('/login');
          return;
        }
        setProfile(res.profileDetails);
        setPinStatusSelect(res.profileDetails.sPinStatus || '0');
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        navigate('/login');
        setLoading(false);
      });
  }, [navigate]);

  const handleUpdatePassword = (e) => {
    e.preventDefault();
    if (!oldpass || !newpass || !confirmPass) {
      setPassError('Please fill in all fields.');
      return;
    }
    if (newpass !== confirmPass) {
      setPassError('New passwords do not match.');
      return;
    }
    if (newpass.length < 8) {
      setPassError('New password must be at least 8 characters long.');
      return;
    }
    setPassError('');
    setPassSuccess('');
    setPassSubmitting(true);

    fetch('/mobile/home/includes/route.php?update-pass=YES', {
      method: 'POST',
      body: new URLSearchParams({ oldpass, newpass }),
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      credentials: 'include'
    })
      .then(res => res.text())
      .then(text => {
        setPassSubmitting(false);
        if (text.includes('0')) {
          setPassSuccess('Password updated successfully.');
          setOldpass('');
          setNewpass('');
          setConfirmPass('');
        } else if (text.includes('1')) {
          setPassError('Incorrect old password.');
        } else {
          setPassError(text.replace(/<[^>]*>/g, '') || 'Failed to update password.');
        }
      })
      .catch(err => {
        console.error(err);
        setPassError('Failed to update password.');
        setPassSubmitting(false);
      });
  };

  const handleUpdatePin = (e) => {
    e.preventDefault();
    if (!oldpin || !newpin || !confirmPinVal) {
      setPinError('Please fill in all fields.');
      return;
    }
    if (newpin !== confirmPinVal) {
      setPinError('New PINs do not match.');
      return;
    }
    if (newpin.length < 4) {
      setPinError('PIN must be 4 digits.');
      return;
    }
    setPinError('');
    setPinSuccess('');
    setPinSubmitting(true);

    fetch('/mobile/home/includes/route.php?update-pin=YES', {
      method: 'POST',
      body: new URLSearchParams({ oldpin, newpin }),
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      credentials: 'include'
    })
      .then(res => res.text())
      .then(text => {
        setPinSubmitting(false);
        if (text.includes('0')) {
          setPinSuccess('PIN updated successfully.');
          setOldpin('');
          setNewpin('');
          setConfirmPinVal('');
        } else if (text.includes('1')) {
          setPinError('Incorrect old PIN.');
        } else {
          setPinError(text.replace(/<[^>]*>/g, '') || 'Failed to update PIN.');
        }
      })
      .catch(err => {
        console.error(err);
        setPinError('Failed to update PIN.');
        setPinSubmitting(false);
      });
  };

  const handleTogglePinStatus = (e) => {
    e.preventDefault();
    if (!disableOldPin) {
      setStatusError('Please enter your current PIN.');
      return;
    }
    setStatusError('');
    setStatusSuccess('');
    setStatusSubmitting(true);

    api.submitAction('profile', 'disable-user-pin', {
      oldpin: disableOldPin,
      pinstatus: pinStatusSelect
    })
      .then(res => {
        setStatusSubmitting(false);
        if (res.msg) {
          if (res.msg.includes('Success') || res.msg.includes('successful') || res.msg.includes('Disabled')) {
            setStatusSuccess(res.msg.replace(/<[^>]*>/g, ''));
            setDisableOldPin('');
            // update local profile status
            if (profile) {
              setProfile({ ...profile, sPinStatus: pinStatusSelect });
            }
          } else {
            setStatusError(res.msg.replace(/<[^>]*>/g, ''));
          }
        } else {
          setStatusSuccess('PIN settings updated successfully.');
        }
      })
      .catch(err => {
        console.error(err);
        setStatusError('Failed to update PIN status.');
        setStatusSubmitting(false);
      });
  };

  const handleLogout = () => {
    api.logout()
      .then(() => {
        navigate('/login');
      })
      .catch(() => {
        // Fallback redirect
        navigate('/login');
      });
  };

  const getRoleLabel = (sType) => {
    const type = String(sType);
    if (type === '2') return 'Agent';
    if (type === '3') return 'Vendor';
    if (type === '4') return 'API User';
    return 'Subscriber';
  };

  if (loading) {
    return (
      <div className="settings-page">
        <Header title="Settings" />
        <div className="loading-container">Loading Settings...</div>
      </div>
    );
  }

  return (
    <div className="settings-page">
      <Header title="Settings" />
      
      <div className="settings-body">
        {/* Profile Card */}
        <div className="profile-card">
          <div className="profile-avatar">
            <img src="/avatar.png" alt="Profile" className="profile-avatar-img" />
          </div>
          <div className="profile-info">
            <h3 className="profile-name">{profile ? `${profile.sFname} ${profile.sLname}` : 'User'}</h3>
            <span className="profile-badge">{getRoleLabel(profile?.sType)}</span>
          </div>
        </div>

        {/* Tab Switcher */}
        <div className="settings-tabs">
          {[
            { id: 'profile', label: 'Profile', icon: User },
            { id: 'password', label: 'Password', icon: Lock },
            { id: 'pin', label: 'PIN', icon: Shield },
          ].map(tab => {
            const Icon = tab.icon;
            return (
              <button
                key={tab.id}
                className={`settings-tab ${activeTab === tab.id ? 'active' : ''}`}
                onClick={() => setActiveTab(tab.id)}
              >
                <Icon size={16} />
                <span>{tab.label}</span>
              </button>
            );
          })}
        </div>

        {/* Profile Tab */}
        {activeTab === 'profile' && (
          <div className="settings-section" key="profile">
            <div className="settings-list">
              <div className="settings-list-item">
                <div className="settings-list-icon"><User size={18} /></div>
                <div className="settings-list-content">
                  <span className="settings-list-label">Full Name</span>
                  <span className="settings-list-value">{profile ? `${profile.sFname} ${profile.sLname}` : ''}</span>
                </div>
                <ChevronRight size={18} className="settings-list-arrow" />
              </div>

              <div className="settings-list-item">
                <div className="settings-list-icon"><Phone size={18} /></div>
                <div className="settings-list-content">
                  <span className="settings-list-label">Phone</span>
                  <span className="settings-list-value">{profile?.sPhone}</span>
                </div>
                <ChevronRight size={18} className="settings-list-arrow" />
              </div>

              <div className="settings-list-item">
                <div className="settings-list-icon"><Mail size={18} /></div>
                <div className="settings-list-content">
                  <span className="settings-list-label">Email</span>
                  <span className="settings-list-value">{profile?.sEmail}</span>
                </div>
                <ChevronRight size={18} className="settings-list-arrow" />
              </div>

              <div className="settings-list-item">
                <div className="settings-list-icon"><MapPin size={18} /></div>
                <div className="settings-list-content">
                  <span className="settings-list-label">State</span>
                  <span className="settings-list-value">{profile?.sState}</span>
                </div>
                <ChevronRight size={18} className="settings-list-arrow" />
              </div>
            </div>

            <button 
              type="button" 
              className="form-submit-btn form-submit-btn--danger logout-btn" 
              onClick={handleLogout}
              style={{ marginTop: '24px', display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '8px' }}
            >
              <LogOut size={18} />
              <span>Sign Out</span>
            </button>
          </div>
        )}

        {/* Password Tab */}
        {activeTab === 'password' && (
          <form onSubmit={handleUpdatePassword} className="settings-section" key="password">
            <div className="settings-section-header">
              <h3 className="settings-section-title">Change Password</h3>
              <p className="settings-section-desc">Use a strong password with at least 8 characters</p>
            </div>

            <div className="form-card">
              {passError && (
                <div className="error-message">
                  <AlertCircle size={16} style={{ marginRight: '8px', verticalAlign: 'middle' }} />
                  {passError}
                </div>
              )}
              {passSuccess && <div className="success-message">{passSuccess}</div>}

              <div className="form-field">
                <label className="form-label">Current Password</label>
                <div className="form-input-wrap">
                  <input 
                    type="password" 
                    placeholder="Enter current password" 
                    value={oldpass}
                    onChange={(e) => setOldpass(e.target.value)}
                    required 
                  />
                </div>
              </div>

              <div className="form-field">
                <label className="form-label">New Password</label>
                <div className="form-input-wrap">
                  <input 
                    type="password" 
                    placeholder="Enter new password" 
                    value={newpass}
                    onChange={(e) => setNewpass(e.target.value)}
                    required 
                  />
                </div>
              </div>

              <div className="form-field">
                <label className="form-label">Confirm New Password</label>
                <div className="form-input-wrap">
                  <input 
                    type="password" 
                    placeholder="Re-enter new password" 
                    value={confirmPass}
                    onChange={(e) => setConfirmPass(e.target.value)}
                    required 
                  />
                </div>
              </div>

              <button type="submit" className="form-submit-btn" disabled={passSubmitting}>
                {passSubmitting ? 'Updating...' : 'Update Password'}
              </button>
            </div>
          </form>
        )}

        {/* PIN Tab */}
        {activeTab === 'pin' && (
          <div className="settings-section" key="pin">
            {/* Update PIN */}
            <form onSubmit={handleUpdatePin}>
              <div className="settings-section-header">
                <h3 className="settings-section-title">Update Transaction PIN</h3>
                <p className="settings-section-desc">Your PIN secures all transactions. Default PIN is 1234.</p>
              </div>

              <div className="form-card">
                {pinError && (
                  <div className="error-message">
                    <AlertCircle size={16} style={{ marginRight: '8px', verticalAlign: 'middle' }} />
                    {pinError}
                  </div>
                )}
                {pinSuccess && <div className="success-message">{pinSuccess}</div>}

                <div className="form-field">
                  <label className="form-label">Current PIN</label>
                  <div className="form-input-wrap">
                    <input 
                      type="password" 
                      placeholder="••••" 
                      maxLength="4" 
                      value={oldpin}
                      onChange={(e) => setOldpin(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="form-field">
                  <label className="form-label">New PIN</label>
                  <div className="form-input-wrap">
                    <input 
                      type="password" 
                      placeholder="••••" 
                      maxLength="4" 
                      value={newpin}
                      onChange={(e) => setNewpin(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="form-field">
                  <label className="form-label">Confirm PIN</label>
                  <div className="form-input-wrap">
                    <input 
                      type="password" 
                      placeholder="••••" 
                      maxLength="4" 
                      value={confirmPinVal}
                      onChange={(e) => setConfirmPinVal(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <button type="submit" className="form-submit-btn" disabled={pinSubmitting}>
                  {pinSubmitting ? 'Updating...' : 'Update PIN'}
                </button>
              </div>
            </form>

            {/* Disable/Enable PIN */}
            <form onSubmit={handleTogglePinStatus}>
              <div className="settings-section-header" style={{ marginTop: '32px' }}>
                <h3 className="settings-section-title">PIN Security Status</h3>
              </div>

              <div className="warning-banner">
                <Shield size={18} />
                <p>Only disable your PIN if your device is secure. Enabling secures transactions.</p>
              </div>

              <div className="form-card">
                {statusError && (
                  <div className="error-message">
                    <AlertCircle size={16} style={{ marginRight: '8px', verticalAlign: 'middle' }} />
                    {statusError}
                  </div>
                )}
                {statusSuccess && <div className="success-message">{statusSuccess}</div>}

                <div className="form-field">
                  <label className="form-label">Current PIN</label>
                  <div className="form-input-wrap">
                    <input 
                      type="password" 
                      placeholder="••••" 
                      maxLength="4" 
                      value={disableOldPin}
                      onChange={(e) => setDisableOldPin(e.target.value)}
                      required 
                    />
                  </div>
                </div>

                <div className="form-field">
                  <label className="form-label">PIN Security</label>
                  <div className="form-select-wrap">
                    <select 
                      value={pinStatusSelect} 
                      onChange={(e) => setPinStatusSelect(e.target.value)}
                      required
                    >
                      <option value="0">Enabled (Require PIN on transactions)</option>
                      <option value="1">Disabled (Fast transactions, no PIN)</option>
                    </select>
                  </div>
                </div>

                <button 
                  type="submit" 
                  className={`form-submit-btn ${pinStatusSelect === '1' ? 'form-submit-btn--danger' : ''}`}
                  disabled={statusSubmitting}
                >
                  {statusSubmitting ? 'Updating...' : pinStatusSelect === '1' ? 'Disable PIN Security' : 'Enable PIN Security'}
                </button>
              </div>
            </form>
          </div>
        )}
      </div>
    </div>
  );
};

export default Settings;
