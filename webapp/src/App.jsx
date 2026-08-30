import { Routes, Route } from 'react-router-dom';
import Register from './pages/Auth/Register';
import Login from './pages/Auth/Login';
import Dashboard from './pages/Home/Dashboard';
import BuyAirtime from './pages/Services/BuyAirtime';
import BuyData from './pages/Services/BuyData';
import BuyCable from './pages/Services/BuyCable';
import BuyElectricity from './pages/Services/BuyElectricity';
import BuyExamPin from './pages/Services/BuyExamPin';
import BuyDataPin from './pages/Services/BuyDataPin';
import VerifyBVN from './pages/Services/VerifyBVN';
import VerifyNIN from './pages/Services/VerifyNIN';
import VerifyNINPhone from './pages/Services/VerifyNINPhone';
import History from './pages/History/History';
import Settings from './pages/Profile/Settings';
import BottomNav from './components/BottomNav/BottomNav';
import './App.css';

function App() {
  return (
    <div className="app-shell">
      <Routes>
        <Route path="/register" element={<Register />} />
        <Route path="/login" element={<Login />} />
        <Route path="/*" element={
          <div className="main-layout">
            <Routes>
              <Route path="/" element={<Dashboard />} />
              <Route path="/airtime" element={<BuyAirtime />} />
              <Route path="/data" element={<BuyData />} />
              <Route path="/cable" element={<BuyCable />} />
              <Route path="/electricity" element={<BuyElectricity />} />
              <Route path="/exam" element={<BuyExamPin />} />
              <Route path="/datapin" element={<BuyDataPin />} />
              <Route path="/verify-bvn" element={<VerifyBVN />} />
              <Route path="/verify-nin" element={<VerifyNIN />} />
              <Route path="/verify-nin-phone" element={<VerifyNINPhone />} />
              <Route path="/history" element={<History />} />
              <Route path="/settings" element={<Settings />} />
            </Routes>
            <BottomNav />
          </div>
        } />
      </Routes>
    </div>
  );
}

export default App;
