package com.example.saramago.modelos;

import java.util.Date;

public class Irregularidade {
    private int id, Leitor_id, TipoIrregularidade_id;
    private Date dataInicial, dataFinal;

    public Irregularidade(int id, int leitor_id, int tipoIrregularidade_id, Date dataInicial, Date dataFinal) {
        this.id = id;
        this.Leitor_id = leitor_id;
        this.TipoIrregularidade_id = tipoIrregularidade_id;
        this.dataInicial = dataInicial;
        this.dataFinal = dataFinal;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public int getLeitor_id() { return Leitor_id; }

    public void setLeitor_id(int leitor_id) { Leitor_id = leitor_id; }

    public int getTipoIrregularidade_id() { return TipoIrregularidade_id; }

    public void setTipoIrregularidade_id(int tipoIrregularidade_id) { TipoIrregularidade_id = tipoIrregularidade_id; }

    public Date getDataInicial() { return dataInicial; }

    public void setDataInicial(Date dataInicial) { this.dataInicial = dataInicial; }

    public Date getDataFinal() { return dataFinal; }

    public void setDataFinal(Date dataFinal) { this.dataFinal = dataFinal; }
}
