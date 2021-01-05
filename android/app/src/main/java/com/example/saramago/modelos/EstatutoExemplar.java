package com.example.saramago.modelos;

public class EstatutoExemplar {
    private int id, prazo;
    private String estatuto;

    public EstatutoExemplar(int id, int prazo, String estatuto) {
        this.id = id;
        this.prazo = prazo;
        this.estatuto = estatuto;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public int getPrazo() { return prazo; }

    public void setPrazo(int prazo) { this.prazo = prazo; }

    public String getEstatuto() { return estatuto; }

    public void setEstatuto(String estatuto) { this.estatuto = estatuto; }
}
