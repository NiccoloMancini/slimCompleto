import logo from './logo.svg';
import './App.css';
import AlunnoRow from './AlunnoRow';
import {useState} from "react";

function App() {

  const [alunni, setAlunni]=useState([]);
  const [loading, setLoading]=useState(false);
  const [inserimento, setInserimento]=useState(false);
  const [nome, setNome]=useState("");
  const [cognome, setCognome]=useState("");

  async function carica(){
    setLoading(true);
    const response = await fetch('http://localhost:8080/alunni');
    const data = await response.json();
    setAlunni(data);
    setLoading(false);
  }

  async function salvaAlunno(){
    setInserimento(false);
    const response = await fetch('http://localhost:8080/alunni', {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({nome: nome, cognome: cognome})
    })
    const data = await response.json(); 
    carica();
  }

  function showInserimento(){                             
    setInserimento(!inserimento);
  }

  async function eliminaAlunno(id) {
    const response = await fetch("http://localhost:8080/alunni/" + id, {
      method: "DELETE"
    })
    carica();
  }

  return(
    <>
      <table>
        {
        alunni.map(alunno =>
            <AlunnoRow alunno={alunno} elimina={(id) => eliminaAlunno(id)} carica={() => carica()}/>
          )
        }
      </table>
      {loading && 
        <p>caricamento...attendere prego</p>
      }
      {alunni.length===0 && !loading &&
        <button onClick={carica}>carica alunni</button>
      }
      {alunni.length>0 && !inserimento &&
        <button onClick={showInserimento}>inserisci</button>
      }
      {inserimento && 
      <div>
          <input type='text' name='cognome' placeholder='Nome' onChange={e => setNome(e.target.value)}></input><br></br>
          <input type='text' name='cognome' placeholder='Cognome' onChange={e => setCognome(e.target.value)}></input><br></br>
          <button onClick={salvaAlunno}>salva</button>
          <button onClick={showInserimento}>annulla</button>
        </div>
      }
    </>
  )
}

export default App;
