import { use, useState } from "react";

export default function AlunnoRow(props){
    const alunno = props.alunno;
    const [deleting, setDeleting] = useState(false);
    const [edit, setEdit] = useState(false);
    const [editNome, setNome] = useState(alunno.nome);
    const [editCognome, setcognome] = useState(alunno.cognome);

    function gestisciEliminazione(){
        setDeleting(false);
        props.elimina(alunno.id);
    }

    async function aggiornaAlunno(){
        setEdit(false);
        const response = await fetch('http://localhost:8080/alunni/' + alunno.id, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({nome: editNome, cognome: editCognome})
        })
        props.carica();
    }

    return (
        <tr>
            <td>{alunno.id}</td>
            <td>{!edit ? (alunno.nome) : (<input type="text" value={editNome} onChange={e => setNome(e.target.value)}></input>)}</td>
            <td>{!edit ? (alunno.cognome) : (<input type="text" value={editCognome} onChange={e => setcognome(e.target.value)}></input>)}</td>
            <td>{!deleting ? (
                <>
                    <button onClick={() => setDeleting(true)}>ELIMINA</button>
                </>) : (
                    <>
                        <label>sicuro? </label>
                        <button onClick={() => gestisciEliminazione()}>SI</button>
                        <button onClick={() => setDeleting(false)}>NO</button>
                    </>
                )
            }</td>
            <td>{!edit ? (<button onClick={() => setEdit(true)}>EDIT</button>) : (<><button onClick={() => aggiornaAlunno()}>SALVA</button> <button onClick={() => setEdit(false)}>ANNULLA</button></>)}
                </td>
        </tr>

    )
}