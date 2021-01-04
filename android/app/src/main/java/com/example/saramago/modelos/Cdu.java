package com.example.saramago.modelos;

public class Cdu {
    private int id;
    private String codCdu, designaco;

    private static int autoIncrement = 1;

    public Cdu(int id, String codCdu, String designaco) {
        this.id = autoIncrement++;
        this.codCdu = codCdu;
        this.designaco = designaco;
    }

    public int getId() { return id; }

    public void setId(int id) { this.id = id; }

    public String getCodCdu() { return codCdu; }

    public void setCodCdu(String codCdu) { this.codCdu = codCdu; }

    public String getDesignaco() { return designaco; }

    public void setDesignaco(String designaco) { this.designaco = designaco; }

}
