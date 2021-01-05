package com.example.saramago.modelos;

import java.util.Date;

public class Leitor {

    private int id, icon, nif, codPostal, telemovel, telefone, Biblioteca_id, TipoLeitor_Id;
    private String nome, dataNasc, codBarras, DocId, morada, localidade,email, mail2, notaInterna;
    private Date dataRegisto, dataAtualizado;
    private static int autoIncrement = 1;

    public Leitor(String nome, int icon, String codBarras, int nif, String DocId, String dataNasc, String morada,
                  String localidade, int codPostal, int telemovel, int telefone, String email,
                  String mail2, Date dataRegisto, Date dataAtualizado, int Biblioteca_id, int TipoLeitor_id){

            this.id = autoIncrement++;
            this.nome = nome;
            this.icon = icon;
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
            this.TipoLeitor_Id = 2;
            // TODO: Tipo de Leitor é um id de outra tabela mas devido ao erro atual
            //  vou ter que passar um numero para conseguir listar sem dar erro
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

    public int getIcon() {
        return icon;
    }

    public void setIcon(int icon) {
        this.icon = icon;
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
        return TipoLeitor_Id;
    }

    public void setTipoLeitor_Id(int tipoLeitor_Id) {
        TipoLeitor_Id = tipoLeitor_Id;
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

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
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

    public Date getDataRegisto() {
        return dataRegisto;
    }

    public void setDataRegisto(Date dataRegisto) {
        this.dataRegisto = dataRegisto;
    }

    public Date getDataAtualizado() {
        return dataAtualizado;
    }

    public void setDataAtualizado(Date dataAtualizado) {
        this.dataAtualizado = dataAtualizado;
    }

    /**
     * Classe aninhada: Funcionario
     */

    public class funcionario{
        private int idFuncionario, Leitor_id;
        private String departamento;

        public funcionario(int id, String departamento, int leitor_id) {
            int autoIncrement = 1;
            this.idFuncionario = autoIncrement++;
            this.Leitor_id = id;
            this.departamento = departamento;
        }

        public int getIdFuncionario() { return idFuncionario; }

        public void setIdFuncionario(int idFuncionario) { this.idFuncionario = idFuncionario; }

        public int getLeitor_id() { return Leitor_id; }

        public void setLeitor_id(int leitor_id) { Leitor_id = leitor_id; }

        public String getDepartamento() { return departamento; }

        public void setDepartamento(String departamento) { this.departamento = departamento; }
    }

    /**
     * Classe aninhada: Aluno
     */

    public class aluno{
        private int idAluno, Leitor_id, numero, Curso_id;

        public aluno(int id, int leitor_id, int numero, int curso_id) {
            int autoIncrement = 1;
            this.idAluno = autoIncrement++;
            this.Leitor_id = id;
            this.numero = numero;
            this.Curso_id = curso_id;
        }

        public int getIdAluno() { return idAluno; }

        public void setIdAluno(int idAluno) { this.idAluno = idAluno; }

        public int getLeitor_id() { return Leitor_id; }

        public void setLeitor_id(int leitor_id) { Leitor_id = leitor_id; }

        public int getNumero() { return numero; }

        public void setNumero(int numero) { this.numero = numero; }

        public int getCurso_id() { return Curso_id; }

        public void setCurso_id(int curso_id) { Curso_id = curso_id; }
    }
}
