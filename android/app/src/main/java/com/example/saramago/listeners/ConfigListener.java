package com.example.saramago.listeners;

import com.example.saramago.modelos.Config;

import java.util.ArrayList;

public interface ConfigListener {

    void onRefreshConfig(ArrayList<Config> listaConfig);

}
