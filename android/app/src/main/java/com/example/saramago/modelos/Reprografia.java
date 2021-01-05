package com.example.saramago.modelos;

import java.util.Date;

public class Reprografia {
    private int id, copias, Leitor_id, Obra_id;
    private boolean frenteVerso;
    private Date dataPedido, dataConcluido, paginas;
    private String operador;
    private String[] cor = {"Cores", "Preto e Branco"};
    private String[] estado = {"aguarda", "processamento", "levantamento", "concluido, "};

    private static int autoIncrement = 1;

    public Reprografia(int id, int copias, int leitor_id, int obra_id,
                       boolean frenteVerso, Date dataPedido, Date dataConcluido, Date paginas,
                       String operador, String[] cor, String[] estado) {
        this.id = id;
        this.copias = copias;
        this.Leitor_id = leitor_id;
        this.Obra_id = obra_id;
        this.frenteVerso = frenteVerso;
        this.dataPedido = dataPedido;
        this.dataConcluido = dataConcluido;
        this.paginas = paginas;
        this.operador = operador;
        this.cor = cor;
        this.estado = estado;
    }

    public int getId() { return id;}

    public void setId(int id) { this.id = id; }

    public int getCopias() { return copias; }

    public void setCopias(int copias) { this.copias = copias; }

    public int getLeitor_id() { return Leitor_id; }

    public void setLeitor_id(int leitor_id) { Leitor_id = leitor_id; }

    public int getObra_id() { return Obra_id; }

    public void setObra_id(int obra_id) { Obra_id = obra_id; }

    public boolean isFrenteVerso() { return frenteVerso; }

    public void setFrenteVerso(boolean frenteVerso) { this.frenteVerso = frenteVerso; }

    public Date getDataPedido() { return dataPedido; }

    public void setDataPedido(Date dataPedido) { this.dataPedido = dataPedido; }

    public Date getDataConcluido() { return dataConcluido; }

    public void setDataConcluido(Date dataConcluido) { this.dataConcluido = dataConcluido; }

    public Date getPaginas() { return paginas; }

    public void setPaginas(Date paginas) { this.paginas = paginas; }

    public String getOperador() { return operador; }

    public void setOperador(String operador) { this.operador = operador; }

    public String[] getCor() { return cor; }

    public void setCor(String[] cor) { this.cor = cor; }

    public String[] getEstado() { return estado; }

    public void setEstado(String[] estado) { this.estado = estado; }
}
