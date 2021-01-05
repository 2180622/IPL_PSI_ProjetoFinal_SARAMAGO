package com.example.saramago.modelos;

public class TipoLeitor {

    private int id;
    private String estatuto;

    private static int autoIncrement = 1;

    public TipoLeitor(int id, String estatuto) {
        this.id = autoIncrement++;
        this.estatuto = estatuto;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public String getEstatuto() { return estatuto; }

    public void setEstatuto(String estatuto) { this.estatuto = estatuto; }

}
