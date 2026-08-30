import { Bell } from 'lucide-react';
import { useNavigate } from 'react-router-dom';
import './Header.css';

const Header = ({ 
  title, 
  showBack = false, 
  transparent = false, 
  showGreeting = false, 
  userName = 'User' 
}) => {
  const navigate = useNavigate();

  return (
    <header className={`header ${transparent ? 'header--transparent' : ''}`} id="app-header">
      <div className="header-row">
        <div className="header-start">
          {showBack ? (
            <button className="header-back" onClick={() => navigate(-1)} aria-label="Go back">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                <polyline points="15 18 9 12 15 6" />
              </svg>
            </button>
          ) : showGreeting ? (
            <button className="header-profile-btn" onClick={() => navigate('/settings')} aria-label="Open profile">
              <img src="avatar.png" alt="Profile" className="header-avatar-img" />
              <div className="header-greeting-wrap">
                <span className="header-greeting-sub">Hi,</span>
                <span className="header-greeting-name">{userName}</span>
              </div>
            </button>
          ) : null}
        </div>
        
        <div className="header-center">
          {title && <h1 className="header-title">{title}</h1>}
        </div>
        
        <div className="header-end">
          <button className="header-action" aria-label="Notifications">
            <Bell size={22} strokeWidth={2} />
            <span className="notification-dot" />
          </button>
        </div>
      </div>
    </header>
  );
};

export default Header;
