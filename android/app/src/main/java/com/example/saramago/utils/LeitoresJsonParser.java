package com.example.saramago.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.saramago.modelos.Leitor;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class LeitoresJsonParser {

    public static ArrayList<Leitor> parserJsonLeitores(JSONArray response) {
        ArrayList<Leitor> leitores = new ArrayList<>();
        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject leitor = (JSONObject) response.get(i);
                int id = leitor.getInt("id");
                String nome = leitor.getString("nome");
                String codBarras = leitor.getString("codBarras");
                int nif = leitor.getInt("nif");
                String DocId = leitor.getString("docId");
                String dataNasc = leitor.getString("dataNasc");
                String morada = leitor.getString("morada");
                String localidade = leitor.getString("localidade");
                int codPostal = leitor.getInt("codPostal");
                int telemovel = leitor.getInt("telemovel");
                int telefone = leitor.getInt("telefone");
                String email = leitor.getString("mail2"); //0
                String mail2 = leitor.getString("mail2");
                int dataRegisto = leitor.getInt("dataRegisto");
                int dataAtualizado = leitor.getInt("dataAtualizado");
                int Biblioteca_id = leitor.getInt("Biblioteca_id");
                int TipoLeitor_id = leitor.getInt("TipoLeitor_id");
                int user_id = leitor.getInt("user_id");

                Leitor auxLeitor = new Leitor(id, nome, codBarras, nif, DocId, dataNasc, morada, localidade, codPostal, telemovel,
                        telefone, email, mail2, dataRegisto, dataAtualizado, Biblioteca_id, TipoLeitor_id, user_id);
                leitores.add(auxLeitor);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return leitores ;
    }

    public static Leitor parserJsonLeitor(String response) {
        Leitor auxLeitor = null;

        try {
            JSONObject leitor = new JSONObject(response);
            int id = leitor.getInt("id");
            String nome = leitor.getString("nome");
            String codBarras = leitor.getString("codBarras");
            int nif = leitor.getInt("nif");
            String DocId = leitor.getString("docId");
            String dataNasc = leitor.getString("dataNasc");
            String morada = leitor.getString("morada");
            String localidade = leitor.getString("localidade");
            int codPostal = leitor.getInt("codPostal");
            int telemovel = leitor.getInt("telemovel");
            int telefone = leitor.getInt("telefone");
            String email = leitor.getString("mail2");
            String mail2 = leitor.getString("mail2");
            int dataRegisto = leitor.getInt("dataRegisto");
            int dataAtualizado = leitor.getInt("dataAtualizado");
            int Biblioteca_id = leitor.getInt("Biblioteca_id");
            int TipoLeitor_id = leitor.getInt("TipoLeitor_id");
            int user_id = leitor.getInt("user_id");


            auxLeitor = new Leitor(id, nome, codBarras, nif, DocId, dataNasc, morada, localidade, codPostal, telemovel,
                    telefone, email, mail2, dataRegisto, dataAtualizado, Biblioteca_id, TipoLeitor_id, user_id);

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return auxLeitor;
    }

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo ni = cm.getActiveNetworkInfo();

        return ni != null && ni.isConnected();
    }
}
