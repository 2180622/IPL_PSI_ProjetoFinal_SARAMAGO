package com.example.saramago.modelos;

public class PostoTrabalho {
    private int id, totalLugares, Biblioteca_id;
    private String designacao, notaInterna;

    private static int autoIncrement;

    public PostoTrabalho(int id, int totalLugares, int biblioteca_id, String designacao, String notaInterna) {
        this.id = autoIncrement++;
        this.totalLugares = totalLugares;
        this.Biblioteca_id = biblioteca_id;
        this.designacao = designacao;
        this.notaInterna = notaInterna;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public int getTotalLugares() { return totalLugares; }

    public void setTotalLugares(int totalLugares) { this.totalLugares = totalLugares; }

    public int getBiblioteca_id() { return Biblioteca_id; }

    public void setBiblioteca_id(int biblioteca_id) { Biblioteca_id = biblioteca_id; }

    public String getDesignacao() { return designacao; }

    public void setDesignacao(String designacao) { this.designacao = designacao; }

    public String getNotaInterna() { return notaInterna; }

    public void setNotaInterna(String notaInterna) { this.notaInterna = notaInterna; }
}