package com.example.saramago.listeners;

import com.example.saramago.modelos.Obra;

import java.util.ArrayList;

public interface ObrasListener {

    void onRefreshListaObras(ArrayList<Obra> listaObras);

    void onRefreshDetalhes();
}
