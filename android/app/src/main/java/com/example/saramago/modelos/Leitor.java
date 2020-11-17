package com.example.saramago.modelos;

import java.util.Date;

public class Leitor {

    private int id, nif, codPostal, telemovel, telefone, Biblioteca_Id, TipoLeitor_Id;
    private String nome, codBarras, DocId, morada, localidade,email, mail2, notaInterna;
    private Date dataNasc, dataRegisto, DataAtualizado;

    public Leitor(int id, String codBarras, int nif, String DocId, Date dataNasc, String morada,
                  String localidade, int codPostal, int telemovel, int telefone, String email,
                  String mail2, Date dataRegisto, Date dataAtualizado){

            this.id = id;
            this.codBarras = codBarras;
    }
}
