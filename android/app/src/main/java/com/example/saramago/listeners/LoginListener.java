package com.example.saramago.listeners;

public interface LoginListener {

    void onValidateLogin(String token, String username, String api);

}