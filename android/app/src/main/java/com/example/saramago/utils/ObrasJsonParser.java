package com.example.saramago.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.saramago.modelos.Obra;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Date;

public class ObrasJsonParser {

    public static ArrayList<Obra> parserJsonObras(JSONArray response) {
        int Colecao_id = 0;
        int preco = 0;
        String resumo ="";
        ArrayList<Obra> obras = new ArrayList<>();
        try {
            for (int i = 0; i < response.length(); i++) {
                JSONObject obra = (JSONObject) response.get(i);
                int id = obra.getInt("id");
                String imgCapa = obra.getString("imgCapa");
                int ano = obra.getInt("ano");
                int Cdu_id = obra.getInt("Cdu_id");
                String titulo = obra.getString("titulo");

                String editor = obra.getString("editor");
                String tipoObra = obra.getString("tipoObra");
                String descricao = obra.getString("descricao");
                String local = obra.getString("local");
                String edicao = obra.getString("edicao");
                String assuntos = obra.getString("assuntos");
                String dataRegisto = obra.getString("dataRegisto");
                String dataAtualizado = obra.getString("dataAtualizado");

                if(obra != null) {
                    if(obra.getString("preco") == null)
                        preco = 0;
                    if(obra.getString("Colecao_id") == null)
                        Colecao_id = 0;
                    if(obra.getString("resumo") == null)
                        resumo = ""; //TODO CONTINUAR AS RESTRIÇOES QUE SAO CAMPOS NULL
                }

                Obra auxObra = new Obra(id, imgCapa, ano, preco, Cdu_id, Colecao_id, titulo, resumo, editor, tipoObra, descricao,
                        local, edicao, assuntos, dataRegisto, dataAtualizado);
                obras.add(auxObra);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return obras ;
    }

    public static Obra parserJsonObra(String response) {
        Obra auxObra = null;
        try {
            JSONObject obra = new JSONObject(response);
            int id = obra.getInt("id");
            String imgCapa = obra.getString("imgCapa");
            int ano = obra.getInt("ano");
            int preco = obra.getInt("preco");
            int Cdu_id = obra.getInt("Cdu_id");
            int Colecao_id = obra.getInt("Colecao_id");
            String titulo = obra.getString("titulo");
            String resumo = obra.getString("resumo");
            String editor = obra.getString("editor");
            String tipoObra = obra.getString("tipoObra");
            String descricao = obra.getString("descricao");
            String local = obra.getString("local");
            String edicao = obra.getString("edicao");
            String assuntos = obra.getString("assuntos");
            String dataRegisto = obra.getString("dataRegisto");
            String dataAtualizado = obra.getString("dataAtualizado");

            auxObra = new Obra(id, imgCapa, ano, preco, Cdu_id, Colecao_id, titulo, resumo, editor, tipoObra, descricao,
                    local, edicao, assuntos, dataRegisto, dataAtualizado);

        } catch (JSONException e) {
            e.printStackTrace();
        }

        return auxObra;
    }

    public static boolean isConnectionInternet(Context context) {
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo ni = cm.getActiveNetworkInfo();

        return ni != null && ni.isConnected();
    }
}
