import Header from '../../components/Header/Header';
import { Clock } from 'lucide-react';
import './History.css';

const History = () => {
  return (
    <div className="history-page">
      <Header title="Transaction History" />
      
      <div className="history-body">
        <div className="history-empty">
          <div className="history-empty-icon">
            <Clock size={40} strokeWidth={1.5} />
          </div>
          <h3 className="history-empty-title">No Transactions Yet</h3>
          <p className="history-empty-text">
            When you buy airtime, data, or pay bills, your transactions will show up here.
          </p>
        </div>
      </div>
    </div>
  );
};

export default History;
