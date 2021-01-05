package com.example.saramago.modelos;

public class Obra_Autor {
    private int Obra_id, Autor_id;

    public Obra_Autor(int obra_id, int autor_id) {
        Obra_id = obra_id;
        Autor_id = autor_id;
    }

    public int getObra_id() { return Obra_id; }

    public void setObra_id(int obra_id) { Obra_id = obra_id; }

    public int getAutor_id() { return Autor_id; }

    public void setAutor_id(int autor_id) { Autor_id = autor_id; }
}
