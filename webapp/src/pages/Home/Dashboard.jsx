import Header from '../../components/Header/Header';
import { 
  Eye, EyeOff, Plus, Headphones, 
  Phone, Wifi, Tv, Zap, GraduationCap, 
  Barcode, CreditCard, Fingerprint, Smartphone,
  ArrowUpRight, ArrowDownLeft, TrendingUp
} from 'lucide-react';
import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { api } from '../../services/api';
import './Dashboard.css';

const services = [
  { id: 1, title: 'Airtime', icon: Phone, color: '#FF375F', bg: 'rgba(255,55,95,0.08)', route: '/airtime' },
  { id: 2, title: 'Data', icon: Wifi, color: '#0A84FF', bg: 'rgba(10,132,255,0.08)', route: '/data' },
  { id: 3, title: 'Cable TV', icon: Tv, color: '#30D158', bg: 'rgba(48,209,88,0.08)', route: '/cable' },
  { id: 4, title: 'Electricity', icon: Zap, color: '#FF9F0A', bg: 'rgba(255,159,10,0.08)', route: '/electricity' },
  { id: 5, title: 'Exam Pin', icon: GraduationCap, color: '#BF5AF2', bg: 'rgba(191,90,242,0.08)', route: '/exam' },
  { id: 6, title: 'Data Pin', icon: Barcode, color: '#64D2FF', bg: 'rgba(100,210,255,0.08)', route: '/datapin' },
  { id: 7, title: 'Verify BVN', icon: CreditCard, color: '#FF6482', bg: 'rgba(255,100,130,0.08)', route: '/verify-bvn' },
  { id: 8, title: 'Verify NIN', icon: Fingerprint, color: '#5E5CE6', bg: 'rgba(94,92,230,0.08)', route: '/verify-nin' },
  { id: 9, title: 'NIN + Phone', icon: Smartphone, color: '#AC8E68', bg: 'rgba(172,142,104,0.08)', route: '/verify-nin-phone' },
];

const quickActions = [
  { icon: ArrowUpRight, label: 'Send', color: '#0A84FF' },
  { icon: ArrowDownLeft, label: 'Request', color: '#30D158' },
  { icon: TrendingUp, label: 'Earn', color: '#BF5AF2' },
];

const Dashboard = () => {
  const navigate = useNavigate();
  const [showBalance, setShowBalance] = useState(true);
  const [profile, setProfile] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api.getPageData('homepage')
      .then(res => {
        if (res.status === 'redirect') {
          navigate('/login');
          return;
        }
        if (res.profileDetails) {
          setProfile(res.profileDetails);
        } else {
          navigate('/login');
        }
        setLoading(false);
      })
      .catch(err => {
        console.error('Failed to load dashboard data:', err);
        navigate('/login');
      });
  }, [navigate]);

  const getRoleLabel = (sType) => {
    const type = String(sType);
    if (type === '2') return 'Agent';
    if (type === '3') return 'Vendor';
    if (type === '4') return 'API User';
    return 'Subscriber';
  };

  const formatMoney = (amount) => {
    const value = parseFloat(amount || 0);
    return '₦' + value.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  };

  if (loading) {
    return (
      <div className="dashboard">
        <Header showGreeting={true} userName="Loading..." />
        <div className="dashboard-body">
          <div className="wallet-card skeleton">
            <div className="skeleton-line" style={{ width: '40%', height: '20px', marginBottom: '15px' }} />
            <div className="skeleton-line" style={{ width: '60%', height: '35px', marginBottom: '20px' }} />
            <div className="skeleton-line" style={{ width: '80%', height: '15px' }} />
          </div>
          <div className="services-grid" style={{ marginTop: '30px' }}>
            {[1, 2, 3, 4, 5, 6].map(i => (
              <div key={i} className="service-item skeleton" style={{ height: '90px' }} />
            ))}
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="dashboard">
      <Header showGreeting={true} userName={profile ? profile.sFname : 'User'} />

      {/* Wallet Card */}
      <div className="dashboard-body">
        <div className="wallet-card">
          <div className="wallet-card-bg" />
          <div className="wallet-card-content">
            <div className="wallet-top">
              <div className="wallet-greeting">
                <span className="wallet-label">Total Balance</span>
                <div className="wallet-balance-row">
                  <h2 className="wallet-balance">
                    {showBalance ? formatMoney(profile?.sWallet) : '••••••'}
                  </h2>
                  <button 
                    className="wallet-eye" 
                    onClick={() => setShowBalance(!showBalance)}
                    aria-label="Toggle balance visibility"
                  >
                    {showBalance ? <Eye size={18} /> : <EyeOff size={18} />}
                  </button>
                </div>
              </div>
            </div>

            <div className="wallet-meta">
              <div className="wallet-meta-item">
                <span className="wallet-meta-label">Commission</span>
                <span className="wallet-meta-value">
                  {showBalance ? formatMoney(profile?.sRefWallet) : '••••••'}
                </span>
              </div>
              <div className="wallet-meta-item">
                <span className="wallet-meta-label">Status</span>
                <span className="wallet-meta-value wallet-status">
                  <span className="status-dot" />
                  {getRoleLabel(profile?.sType)}
                </span>
              </div>
            </div>

            <div className="wallet-actions">
              <button className="wallet-action-btn" id="add-money-btn">
                <Plus size={18} strokeWidth={2.5} />
                <span>Add Money</span>
              </button>
              <button className="wallet-action-btn wallet-action-btn--outline" id="contact-btn">
                <Headphones size={18} />
                <span>Support</span>
              </button>
            </div>
          </div>
        </div>

        {/* Quick Actions */}
        <div className="quick-actions">
          {quickActions.map((action, i) => {
            const Icon = action.icon;
            return (
              <button key={i} className="quick-action-item">
                <div className="quick-action-icon" style={{ background: `${action.color}10`, color: action.color }}>
                  <Icon size={20} strokeWidth={2.2} />
                </div>
                <span className="quick-action-label">{action.label}</span>
              </button>
            );
          })}
        </div>

        {/* Services */}
        <div className="section">
          <div className="section-header">
            <h3 className="section-title">Services</h3>
            <button className="section-link">See all</button>
          </div>

          <div className="services-grid">
            {services.map((service, i) => {
              const Icon = service.icon;
              return (
                <button 
                  key={service.id} 
                  className="service-item"
                  onClick={() => navigate(service.route)}
                  style={{ animationDelay: `${i * 40}ms` }}
                >
                  <div className="service-icon" style={{ background: service.bg, color: service.color }}>
                    <Icon size={22} strokeWidth={1.8} />
                  </div>
                  <span className="service-label">{service.title}</span>
                </button>
              );
            })}
          </div>
        </div>

        {/* Recent Activity Preview */}
        <div className="section">
          <div className="section-header">
            <h3 className="section-title">Recent Activity</h3>
            <button className="section-link" onClick={() => navigate('/history')}>View all</button>
          </div>
          <div className="empty-state">
            <div className="empty-icon">📋</div>
            <p className="empty-text">No transactions yet</p>
            <p className="empty-sub">Your recent transactions will appear here</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
