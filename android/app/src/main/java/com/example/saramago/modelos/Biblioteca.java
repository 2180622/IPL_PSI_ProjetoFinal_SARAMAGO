package com.example.saramago.modelos;

public class Biblioteca {
    private int id;
    private String codBiblioteca, nome;

    private static int autoIncrement = 1;

    public Biblioteca(int id, String codBiblioteca, String nome) {
        this.id = autoIncrement++;
        this.codBiblioteca = codBiblioteca;
        this.nome = nome;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public String getCodBiblioteca() { return codBiblioteca; }

    public void setCodBiblioteca(String codBiblioteca) { this.codBiblioteca = codBiblioteca; }

    public String getNome() { return nome; }

    public void setNome(String nome) { this.nome = nome; }

}
