import { NavLink, useLocation } from 'react-router-dom';
import { Home, Phone, Wifi, Clock, User } from 'lucide-react';
import './BottomNav.css';

const navItems = [
  { path: '/', icon: Home, label: 'Home' },
  { path: '/airtime', icon: Phone, label: 'Airtime' },
  { path: '/data', icon: Wifi, label: 'Data', isCenter: true },
  { path: '/history', icon: Clock, label: 'History' },
  { path: '/settings', icon: User, label: 'Profile' },
];

const BottomNav = () => {
  const location = useLocation();

  return (
    <nav className="bottom-nav" id="bottom-navigation">
      <div className="nav-inner">
        {navItems.map((item) => {
          const Icon = item.icon;
          const isActive = location.pathname === item.path;

          if (item.isCenter) {
            return (
              <NavLink key={item.path} to={item.path} className="nav-center-wrap">
                <div className={`nav-center-btn ${isActive ? 'active' : ''}`}>
                  <Icon size={22} strokeWidth={2.5} />
                </div>
                <span className="nav-center-label">{item.label}</span>
              </NavLink>
            );
          }

          return (
            <NavLink
              key={item.path}
              to={item.path}
              className={`nav-tab ${isActive ? 'active' : ''}`}
            >
              <div className="nav-tab-icon">
                <Icon size={22} strokeWidth={isActive ? 2.5 : 1.8} />
              </div>
              <span className="nav-tab-label">{item.label}</span>
              {isActive && <div className="nav-tab-indicator" />}
            </NavLink>
          );
        })}
      </div>
    </nav>
  );
};

export default BottomNav;
