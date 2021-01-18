package com.example.saramago.modelos;

public class Leitor {

    private int id, nif, codPostal, telemovel, telefone, Biblioteca_id, TipoLeitor_id;
    private String nome, username, dataNasc, codBarras, DocId, morada, localidade, email, mail2, notaInterna, dataRegisto, dataAtualizado;

    public Leitor(int id, String nome, String username, String codBarras, int nif, String DocId, String dataNasc, String morada,
                  String localidade, int codPostal, int telemovel, int telefone, String email, String mail2,
                  String dataRegisto, String dataAtualizado, int Biblioteca_id, int TipoLeitor_id) {

        this.id = id;
        this.username = username;
        this.nome = nome;
        this.codBarras = codBarras;
        this.nif = nif;
        this.DocId = DocId;
        this.dataNasc = dataNasc;
        this.morada = morada;
        this.localidade = localidade;
        this.codPostal = codPostal;
        this.telemovel = telemovel;
        this.telefone = telefone;
        this.email = email;
        this.mail2 = mail2;
        this.dataRegisto = dataRegisto;
        this.dataAtualizado = dataAtualizado;
        this.Biblioteca_id = Biblioteca_id;
        this.TipoLeitor_id = TipoLeitor_id;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public int getNif() {
        return nif;
    }

    public void setNif(int nif) {
        this.nif = nif;
    }

    public int getCodPostal() {
        return codPostal;
    }

    public void setCodPostal(int codPostal) {
        this.codPostal = codPostal;
    }

    public int getTelemovel() {
        return telemovel;
    }

    public void setTelemovel(int telemovel) {
        this.telemovel = telemovel;
    }

    public int getTelefone() {
        return telefone;
    }

    public void setTelefone(int telefone) {
        this.telefone = telefone;
    }

    public int getBiblioteca_id() {
        return Biblioteca_id;
    }

    public void setBiblioteca_id(int biblioteca_id) {
        Biblioteca_id = biblioteca_id;
    }

    public int getTipoLeitor_Id() {
        return TipoLeitor_id;
    }

    public void setTipoLeitor_Id(int tipoLeitor_Id) {
        TipoLeitor_id = tipoLeitor_Id;
    }

    public String getCodBarras() {
        return codBarras;
    }

    public void setCodBarras(String codBarras) {
        this.codBarras = codBarras;
    }

    public String getDocId() {
        return DocId;
    }

    public void setDocId(String docId) {
        DocId = docId;
    }

    public String getMorada() {
        return morada;
    }

    public void setMorada(String morada) {
        this.morada = morada;
    }

    public String getLocalidade() {
        return localidade;
    }

    public void setLocalidade(String localidade) {
        this.localidade = localidade;
    }

    public String getMail2() {
        return mail2;
    }

    public void setMail2(String mail2) {
        this.mail2 = mail2;
    }

    public String getNotaInterna() {
        return notaInterna;
    }

    public void setNotaInterna(String notaInterna) {
        this.notaInterna = notaInterna;
    }

    public String getDataNasc() {
        return dataNasc;
    }

    public void setDataNasc(String dataNasc) {
        this.dataNasc = dataNasc;
    }

    public String getDataRegisto() {
        return dataRegisto;
    }

    public void setDataRegisto(String dataRegisto) {
        this.dataRegisto = dataRegisto;
    }

    public String getDataAtualizado() {
        return dataAtualizado;
    }

    public void setDataAtualizado(String dataAtualizado) {
        this.dataAtualizado = dataAtualizado;
    }

    public int getTipoLeitor_id() {
        return TipoLeitor_id;
    }

    public void setTipoLeitor_id(int tipoLeitor_id) {
        TipoLeitor_id = tipoLeitor_id;
    }

    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }
}