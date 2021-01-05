package com.example.saramago.modelos;

import java.util.Date;

public class Autor {
    private int id, orcid;
    private String primeiroNome, segundoNome, apelido, bibliografia, nacionalidade;
    private String[] tipo = {"individual","coletivo"};
    private Date dataNasc;

    public Autor(int id, int orcid, String primeiroNome, String segundoNome, String apelido, String bibliografia, String nacionalidade, String[] tipo, Date dataNasc) {
        this.id = id;
        this.orcid = orcid;
        this.primeiroNome = primeiroNome;
        this.segundoNome = segundoNome;
        this.apelido = apelido;
        this.bibliografia = bibliografia;
        this.nacionalidade = nacionalidade;
        this.tipo = tipo;
        this.dataNasc = dataNasc;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public int getOrcid() { return orcid; }

    public void setOrcid(int orcid) { this.orcid = orcid; }

    public String getPrimeiroNome() { return primeiroNome; }

    public void setPrimeiroNome(String primeiroNome) { this.primeiroNome = primeiroNome; }

    public String getSegundoNome() { return segundoNome; }

    public void setSegundoNome(String segundoNome) { this.segundoNome = segundoNome; }

    public String getApelido() { return apelido; }

    public void setApelido(String apelido) { this.apelido = apelido; }

    public String getBibliografia() { return bibliografia; }

    public void setBibliografia(String bibliografia) { this.bibliografia = bibliografia; }

    public String getNacionalidade() { return nacionalidade; }

    public void setNacionalidade(String nacionalidade) { this.nacionalidade = nacionalidade; }

    public String[] getTipo() { return tipo; }

    public void setTipo(String[] tipo) { this.tipo = tipo; }

    public Date getDataNasc() { return dataNasc; }

    public void setDataNasc(Date dataNasc) { this.dataNasc = dataNasc; }
}
