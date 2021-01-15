package com.example.saramago.modelos;

import android.content.Context;
import android.widget.Toast;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.saramago.R;
import com.example.saramago.listeners.LeitoresListener;
import com.example.saramago.utils.LeitoresJsonParser;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class SingletonGestorBiblioteca {
    private static SingletonGestorBiblioteca instance = null;
    private static final String urlAPILeitores = "https://localhost:80/IPL_PSI_ProjetoFinal2/saramago/api/web/v1/leitor";
    private ArrayList<Leitor> leitores;
    int currentTime = (int) (new Date().getTime()/1000);
    private LeitoresListener leitoresListener;
    private SaramagoBDHelper saramagoBD;
    private static RequestQueue volleyQueue = null;

    public static synchronized SingletonGestorBiblioteca getInstance(Context context){
        if(instance == null){
            instance = new SingletonGestorBiblioteca(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    private SingletonGestorBiblioteca(Context context){
        leitores = new ArrayList<>();
        saramagoBD = new SaramagoBDHelper(context);
    }

    private void gerarLeitores(){
        // instanciar o array de livros
        leitores = new ArrayList<>();
        leitores.add(new Leitor(1, "Alfredo", "696969", 269745017, "069", "2000/02/02", "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", currentTime, currentTime,1,1,1));
        leitores.add(new Leitor(2, "Joaquim", "690420", 123456789, "420", "2000/02/02", "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", currentTime, currentTime,2,2,2));
    }
    public ArrayList<Leitor> getLeitores(){
        leitores = saramagoBD.getAllLeitoresBD();
        return leitores;
    }
    public Leitor getLeitor(int id)
    {
        for(Leitor leitor: leitores)
        {
            if(leitor.getId()==id)
            {
                return leitor;
            }
        }
        return null;
    }
    public void adicionarLeitor(Leitor livro){
        leitores.add(livro);
    }
    public void editarLeitor(Leitor leitor){
        Leitor l = getLeitor(leitor.getId());

        if(leitor != null){
            l.setCodBarras(leitor.getCodBarras());
            l.setNif(leitor.getNif());
            l.setDocId(leitor.getDocId());
            l.setDataNasc(leitor.getDataNasc());
            l.setMorada(leitor.getMorada());
            l.setLocalidade(leitor.getLocalidade());
            l.setCodPostal(leitor.getCodPostal());
            l.setTelemovel(leitor.getTelemovel());
            l.setTelefone(leitor.getTelefone());
            l.setEmail(leitor.getEmail());
            l.setMail2(leitor.getMail2());
            l.setDataRegisto(leitor.getDataRegisto());
            l.setDataAtualizado(leitor.getDataAtualizado());
        }
    }
    public void removerLeitor(int id){
        Leitor leitor = getLeitor(id);
        if(leitor != null){
            leitores.remove(leitor);
        }
    }

    public void setLeitoresListener(LeitoresListener leitoresListener) {
        this.leitoresListener = leitoresListener;
    }

    /****************************** BD ******************************************/

    public void adicionarLeitorBD(Leitor leitor) {
        saramagoBD.adicionarLivroBD(leitor);
    }

    public void adicionarLeitoresBD(ArrayList<Leitor> leitores) {
        saramagoBD.removerAllLeitoresBD();
        for (Leitor leitor : leitores)
            adicionarLeitorBD(leitor);
    }

    /****************************** API *****************************************/
    public void getAllLeitoresAPI(final Context context){
        if(!LeitoresJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if(leitoresListener != null){
                leitoresListener.onRefreshListaLeitores(saramagoBD.getAllLeitoresBD());
            }
        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, urlAPILeitores, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    leitores = LeitoresJsonParser.parserJsonLeitores(response);
                    adicionarLeitoresBD(leitores);

                    if (leitoresListener != null) {
                        leitoresListener.onRefreshListaLeitores(leitores);
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(request);
        }
    }

}
