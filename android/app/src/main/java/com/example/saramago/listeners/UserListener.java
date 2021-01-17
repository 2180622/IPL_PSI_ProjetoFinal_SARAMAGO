package com.example.saramago.listeners;

import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.User;

import java.util.ArrayList;

public interface UserListener {

    void onRefreshListaUsers(ArrayList<User> listaUsers);

    void onRefreshDetalhes();
}
