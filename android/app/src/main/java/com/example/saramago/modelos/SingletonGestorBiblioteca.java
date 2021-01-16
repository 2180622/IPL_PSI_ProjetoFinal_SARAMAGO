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
import com.example.saramago.listeners.LoginListener;
import com.example.saramago.listeners.ObrasListener;
import com.example.saramago.utils.LeitoresJsonParser;
import com.example.saramago.utils.ObrasJsonParser;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;

public class SingletonGestorBiblioteca {
    private static SingletonGestorBiblioteca instance = null;
    int  currentTime = (int)(new Date().getTime()/1000);
    private LoginListener loginListener;
    // IP LOCAL PARA A API
    private static final String iplocalhost = "192.168.1.77";
    private static final String urlAPILeitores = "https://"+iplocalhost+"/IPL_PSI_ProjetoFinal2/saramago/api/web/v1/leitor";
    private static final String urlAPIObras = "https://"+iplocalhost+"/IPL_PSI_ProjetoFinal2/saramago/api/web/v1/obra";
    private ObrasListener obrasListener;
    private ArrayList<Obra> obras;
    private LeitoresListener leitoresListener;
    private ArrayList<Leitor> leitores;
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
        obras = new ArrayList<>();
        saramagoBD = new SaramagoBDHelper(context);
    }

    /****************************** CRUD Leitor ******************************************/

    private void gerarLeitores(){
        // instanciar o array de livros
        leitores = new ArrayList<>();
        leitores.add(new Leitor(1, "Alfredo", "696969", 269745017, "069", "2000/02/02", "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", Integer.toString(currentTime), Integer.toString(currentTime),1,1,1));
        leitores.add(new Leitor(2, "Joaquim", "690420", 123456789, "420", "2000/02/02", "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", Integer.toString(currentTime), Integer.toString(currentTime),2,2,2));
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
    public void adicionarLeitor(Leitor leitor){
        leitores.add(leitor);
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

    public void setLoginListener(LoginListener loginListener) {
        this.loginListener = loginListener;
    }

    /****************************** CRUD Leitor ******************************************/

    private void gerarObras(){
        // instanciar o array de livros
        obras = new ArrayList<>();
        //obras.add(new Obra(1, "Alfredo", "696969", 269745017, "069", "2000/02/02", "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", currentTime, currentTime,1,1,1));
        //obras.add(new Obra(2, "Joaquim", "690420", 123456789, "420", "2000/02/02", "Rua do Leitor", "Leiria", 2400653, 919191919, 262088200, "leitor@hotmail.com", "leitor2@gmail.com", currentTime, currentTime,2,2,2));
    }
    public ArrayList<Obra> getObras(){
        obras = saramagoBD.getAllObrasBD();
        return obras;
    }
    public Obra getObra(int id)
    {
        for(Obra obra: obras)
        {
            if(obra.getId()==id)
            {
                return obra;
            }
        }
        return null;
    }
    public void adicionarObra(Obra obra){
        obras.add(obra);
    }
    public void editarObra(Obra obra){
        Obra l = getObra(obra.getId());

        if(obra != null){
            l.setImgCapa(obra.getImgCapa());
            l.setTitulo(obra.getTitulo());
            l.setResumo(obra.getResumo());
            l.setEditor(obra.getEditor());
            l.setAno(obra.getAno());
            l.setTipoObra(obra.getTipoObra());
            l.setDescricao(obra.getDescricao());
            l.setLocal(obra.getLocal());
            l.setEdicao(obra.getEdicao());
            l.setAssuntos(obra.getAssuntos());
            l.setDataRegisto(obra.getDataRegisto());
            l.setDataAtualizado(obra.getDataAtualizado());
            l.setCdu_id(obra.getCdu_id());
        }
    }
    public void removerObra(int id){
        Obra obra = getObra(id);
        if(obra != null){
            obras.remove(obra);
        }
    }

    public void setObrasListener(ObrasListener obrasListener) {
        this.obrasListener = obrasListener;
    }


    /****************************** BD Leitor ******************************************/

    public void adicionarLeitorBD(Leitor leitor) {
        saramagoBD.adicionarLeitorBD(leitor);
    }

    public void adicionarLeitoresBD(ArrayList<Leitor> leitores) {
        saramagoBD.removerAllLeitoresBD();
        for (Leitor leitor : leitores)
            adicionarLeitorBD(leitor);
    }
    /****************************** BD Obras ******************************************/
    public void adicionarObraBD(Obra obra) {
        saramagoBD.adicionarObraBD(obra);
    }

    public void adicionarObrasBD(ArrayList<Obra> obras) {
        saramagoBD.removerAllObrasBD();
        for (Obra obra : obras)
            adicionarObraBD(obra);
    }

    /****************************** Leitores API *****************************************/
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

    /****************************** Obras API *****************************************/
    public void getAllObrasAPI(final Context context){
        if(!ObrasJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if(obrasListener != null){
                obrasListener.onRefreshListaObras(saramagoBD.getAllObrasBD());
            }
        }else{
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, urlAPIObras, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    obras = ObrasJsonParser.parserJsonObras(response);
                    adicionarObrasBD(obras);

                    if (obrasListener != null) {
                        obrasListener.onRefreshListaObras(obras);
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
