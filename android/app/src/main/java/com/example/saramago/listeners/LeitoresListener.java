package com.example.saramago.listeners;

import com.example.saramago.modelos.Leitor;
import java.util.ArrayList;

public interface LeitoresListener {

    void onRefreshListaLeitores(ArrayList<Leitor> listaLeitores);

    void onRefreshDetalhes();
}
