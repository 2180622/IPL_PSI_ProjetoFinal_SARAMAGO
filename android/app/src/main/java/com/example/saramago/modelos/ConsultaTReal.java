package com.example.saramago.modelos;

import java.util.Date;

public class ConsultaTReal {
    private int id, Leitor_id, Exemplar_id;
    private Date dataHoraInicial, dataHoraFinal;
    private String operador;

    private static int autoIncrement = 1;

    public ConsultaTReal(int id, int leitor_id, int exemplar_id, Date dataHoraInicial, Date dataHoraFinal, String operador) {
        this.id = autoIncrement++;
        this.Leitor_id = leitor_id;
        this.Exemplar_id = exemplar_id;
        this.dataHoraInicial = dataHoraInicial;
        this.dataHoraFinal = dataHoraFinal;
        this.operador = operador;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public int getLeitor_id() { return Leitor_id; }

    public void setLeitor_id(int leitor_id) { Leitor_id = leitor_id; }

    public int getExemplar_id() { return Exemplar_id; }

    public void setExemplar_id(int exemplar_id) { Exemplar_id = exemplar_id; }

    public Date getDataHoraInicial() { return dataHoraInicial; }

    public void setDataHoraInicial(Date dataHoraInicial) { this.dataHoraInicial = dataHoraInicial; }

    public Date getDataHoraFinal() { return dataHoraFinal; }

    public void setDataHoraFinal(Date dataHoraFinal) { this.dataHoraFinal = dataHoraFinal; }

    public String getOperador() { return operador; }

    public void setOperador(String operador) { this.operador = operador; }
}
