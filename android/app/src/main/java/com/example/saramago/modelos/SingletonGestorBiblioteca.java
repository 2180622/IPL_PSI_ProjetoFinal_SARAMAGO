package com.example.saramago.modelos;

import android.content.Context;
import android.content.SharedPreferences;
import android.database.sqlite.SQLiteDatabase;
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
import com.example.saramago.listeners.ObrasListener;
import com.example.saramago.listeners.LoginListener;
import com.example.saramago.listeners.UserListener;
import com.example.saramago.utils.LeitoresJsonParser;
import com.example.saramago.utils.ObrasJsonParser;
import com.example.saramago.utils.LoginJsonParser;
import com.example.saramago.utils.UserJsonParser;
import com.example.saramago.vistas.LoginActivity;
import com.example.saramago.vistas.MenuMainActivity;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import static com.example.saramago.vistas.MenuMainActivity.API;

public class SingletonGestorBiblioteca {
    private static SingletonGestorBiblioteca instance = null;
    //private static final String urlAPI = "https://10.0.2.2/IPL_PSI_ProjetoFinal_SARAMAGO/saramago/api/web/v1/leitor";
    private static final String urlAPILeitores = "/v1/leitor";
    private static final String urlAPIUsers = "/v1/user";
    private static final String urlAPILogin = "/v1/auth/login";
    private static final String urlAPIObras = "/v1/cat/obra";
    private ObrasListener obrasListener;
    private ArrayList<Obra> obras;
    private ArrayList<Leitor> leitores;
    private ArrayList<User> users;
    int  currentTime = (int)(new Date().getTime()/1000);
    private LeitoresListener leitoresListener;
    private UserListener usersListener;

    private LoginListener loginListener;
    private SaramagoBDHelper saramagoBD;
    private static RequestQueue volleyQueue = null;
    private Context context;

    public static synchronized SingletonGestorBiblioteca getInstance(Context context){
        if(instance == null){
            instance = new SingletonGestorBiblioteca(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    private SingletonGestorBiblioteca(Context context){
        leitores = new ArrayList<>();
        users = new ArrayList<>();
        obras = new ArrayList<>();
        saramagoBD = new SaramagoBDHelper(context);
    }

    public User getUser_id(int leitor_id){
        for (User user: users){
            if(user.getId() == leitor_id){
                return user;
            }
        }
        return null;
    }
    //region Leitor CRUD
    private void gerarLeitores() {
        // instanciar o array de livros
        leitores = new ArrayList<>();
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

    public User getUser(int id){
        for(User user: users){
            if(user.getId()==id)
                return user;
        }
        return null;
    }

    public void setLeitoresListener(LeitoresListener leitoresListener) {
        this.leitoresListener = leitoresListener;
    }

    public void setUserListener(UserListener userListener){
        this.usersListener = userListener;
    }

    //endregion

    //region catalogo CRUD
    private void gerarObras(){
        // instanciar o array de livros
        obras = new ArrayList<>();
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
            l.setPreco(obra.getPreco());
            l.setDataRegisto(obra.getDataRegisto());
            l.setDataAtualizado(obra.getDataAtualizado());
            l.setCdu_id(obra.getCdu_id());
            l.setColecao_id(obra.getColecao_id());
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
    //endregion

    //region BD leitor

    public void adicionarLeitorBD(Leitor leitor) {
        saramagoBD.adicionarLeitorBD(leitor);
    }

    public void adicionarLeitoresBD(ArrayList<Leitor> leitores) {
        saramagoBD.removerAllLeitoresBD();
        for (Leitor leitor : leitores)
            adicionarLeitorBD(leitor);
    }

    //endregion

    //region BD user
    public void adicionarUserBD(User user) {
        saramagoBD.adicionarUserBD(user);
    }
    public void adicionarUsersBD(ArrayList<User> users) {
        saramagoBD.removerAllUserssBD();
        for (User user : users)
            adicionarUserBD(user);
    }
    //endregion

    //region BD obra

    public void adicionarObraBD(Obra obra) {
        saramagoBD.adicionarObraBD(obra);
    }

    public void adicionarObrasBD(ArrayList<Obra> obras) {
        saramagoBD.removerAllObrasBD();
        for (Obra obra : obras)
            adicionarObraBD(obra);
    }

    //endregion

    //region API login

    public void setLoginListener(LoginActivity loginActivity)
    {
        this.loginListener = loginActivity;
    }

    public void loginAPI(final String username, final String password, final String api, final Context context){
        StringRequest req = new StringRequest(Request.Method.POST, api + urlAPILogin,  new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                String token = LoginJsonParser.parserJsonLogin(response);

                //informar a lista
                if(loginListener != null)
                {
                    loginListener.onValidateLogin(token, username, api);

                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error)
            {
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String,String> params=new HashMap<>();
                params.put("username",username);
                params.put("password",password);
                return params;
            }
        };
        volleyQueue.add(req);
    }

    //endregion

    //region API leitores
    public void getAllLeitoresAPI(final Context context){
        if(!LeitoresJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if(leitoresListener != null){
                leitoresListener.onRefreshListaLeitores(saramagoBD.getAllLeitoresBD());
            }
        }else{
            SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
            String api = sharedPreferences.getString(API, "");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, api + urlAPILeitores, null, new Response.Listener<JSONArray>() {
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
    //endregion

    //region API users
    public void getAllUsersAPI(final Context context){
        if(!UserJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if( usersListener != null){
                usersListener.onRefreshListaUsers(saramagoBD.getAllUsersBD());
            }
        }else{
            SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
            String api = sharedPreferences.getString(API, "");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, api + urlAPIUsers, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    users = UserJsonParser.parserJsonUser(response);
                    adicionarUsersBD(users);

                    if (usersListener != null) {
                        usersListener.onRefreshListaUsers(users);
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
    //endregion

    //region API obras
    public void getAllObrasAPI(final Context context){
        if(!ObrasJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if(obrasListener != null){
                obrasListener.onRefreshListaObras(saramagoBD.getAllObrasBD());
            }
        }else{
            SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
            String api = sharedPreferences.getString(API, "");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET, api + urlAPIObras, null, new Response.Listener<JSONArray>() {
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

    //endregion

}


