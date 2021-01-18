package com.example.saramago.modelos;

import android.content.Context;
import android.content.SharedPreferences;
import android.widget.Toast;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.saramago.R;
import com.example.saramago.listeners.ConfigListener;
import com.example.saramago.listeners.LeitoresListener;
import com.example.saramago.listeners.ObrasListener;
import com.example.saramago.listeners.LoginListener;
import com.example.saramago.listeners.UserListener;
import com.example.saramago.utils.ConfigJsonParser;
import com.example.saramago.utils.LeitoresJsonParser;
import com.example.saramago.utils.ObrasJsonParser;
import com.example.saramago.utils.LoginJsonParser;
import com.example.saramago.vistas.LoginActivity;
import com.example.saramago.vistas.MenuMainActivity;

import org.json.JSONArray;

import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

import static com.example.saramago.vistas.MenuMainActivity.API;
import static com.example.saramago.vistas.MenuMainActivity.TOKEN;

public class SingletonGestorBiblioteca {
    private static SingletonGestorBiblioteca instance = null;
    private static final int ADICIONAR_BD = 1;
    private static final int EDITAR_BD =2 ;
    private static final int REMOVER_BD =3 ;
    //private static final String urlAPI = "http://10.0.2.2/IPL_PSI_ProjetoFinal_SARAMAGO/saramago/api/web/";
    private static final String queryParamAuth = "?access-token=";
    private static final String urlAPILeitores = "/v1/leitor";
    private static final String urlAPILeitoresCreate = "/v1/leitor/create";
    private static final String urlAPILeitoresEdit = "/v1/leitor/update";
    private static final String urlAPILeitoresDelete = "/v1/leitor/delete";
    private static final String urlAPIObrasCreate = "/v1/cat/obra/create";
    private static final String urlAPIObrasEdit = "/v1/cat/obra/edit/";
    private static final String urlAPIUsers = "/v1/user";
    private static final String urlAPILogin = "/v1/auth/login";
    private static final String urlAPIObras = "/v1/cat/obra";
    private static final String urlAPIConfig = "/v1/config";

    private ObrasListener obrasListener;
    private ArrayList<Obra> obras;
    private ArrayList<Leitor> leitores;
    private ArrayList<Config> config;
    private ArrayList<User> users;
    int  currentTime = (int)(new Date().getTime()/1000);
    private LeitoresListener leitoresListener;
    private UserListener usersListener;

    private LoginListener loginListener;
    private ConfigListener configListener;
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
        config = new ArrayList<>();
        saramagoBD = new SaramagoBDHelper(context);
    }

    //region Leitor CRUD

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

        if(leitor != null)
        {
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

    public void setLeitoresListener(LeitoresListener leitoresListener) {
        this.leitoresListener = leitoresListener;
    }


    //endregion

    //region catalogo CRUD
    private void gerarObras(){
        // instanciar o array de obras
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
        Obra ob = getObra(obra.getId());

        if(obra != null){
            ob.setImgCapa(obra.getImgCapa());
            ob.setTitulo(obra.getTitulo());
            ob.setResumo(obra.getResumo());
            ob.setEditor(obra.getEditor());
            ob.setAno(obra.getAno());
            ob.setTipoObra(obra.getTipoObra());
            ob.setDescricao(obra.getDescricao());
            ob.setLocal(obra.getLocal());
            ob.setEdicao(obra.getEdicao());
            ob.setAssuntos(obra.getAssuntos());
            ob.setPreco(obra.getPreco());
            ob.setDataRegisto(obra.getDataRegisto());
            ob.setDataAtualizado(obra.getDataAtualizado());
            ob.setCdu_id(obra.getCdu_id());
            ob.setColecao_id(obra.getColecao_id());
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

    public void removerLeitorBD(int id) {
        Leitor leitor = getLeitor(id);

        if (leitor != null)
            saramagoBD.removerLeitorBD(id);
    }

    public void editarLeitorBD(Leitor leitor) {
        Leitor l = getLeitor(leitor.getId());

        if (l != null) {
            if (saramagoBD.editarLeitorBD(leitor)) {
                l.setNome(leitor.getNome());
                l.setUsername(leitor.getUsername());
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
                l.setBiblioteca_id(leitor.getBiblioteca_id());
                l.setTipoLeitor_Id(leitor.getTipoLeitor_id());
            }
        }

    }

    //endregion

    //region BD user
    public void adicionarUserBD(User user) {
        saramagoBD.adicionarUserBD(user);
    }
    public void adicionarUsersBD(ArrayList<User> users) {
        saramagoBD.removerAllUsersBD();
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

    public void removerObraBD(int id) {
        Obra obra = getObra(id);

        if (obra != null)
            saramagoBD.removerObraBD(id);
    }

    public void editarObraBD(Obra obra) {
        Obra ob = getObra(obra.getId());

        if (ob != null) {
            if (saramagoBD.editarObraBD(obra)) {
                ob.setImgCapa(obra.getImgCapa());
                ob.setTitulo(obra.getTitulo());
                ob.setResumo(obra.getResumo());
                ob.setEditor(obra.getEditor());
                ob.setAno(obra.getAno());
                ob.setTipoObra(obra.getTipoObra());
                ob.setDescricao(obra.getDescricao());
                ob.setLocal(obra.getLocal());
                ob.setEdicao(obra.getEdicao());
                ob.setAssuntos(obra.getAssuntos());
                ob.setPreco(obra.getPreco());
                ob.setDataRegisto(obra.getDataRegisto());
                ob.setDataAtualizado(obra.getDataAtualizado());
                ob.setCdu_id(obra.getCdu_id());
                ob.setColecao_id(obra.getColecao_id());
            }

        }

    }

    //endregion

    //region BD config

    public void adicionarConfigsBD(ArrayList<Config> configs)
    {
        saramagoBD.removerConfigBD();
        for (Config config : configs)
        {
            adicionarConfigBD(config);
        }
    }

    public void adicionarConfigBD(Config config)
    {
        saramagoBD.adicionarConfigBD(config);

    }

    public void setConfigListener(ConfigListener configListener) {
        this.configListener = configListener;
    }

    //region BD config

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

                if(loginListener != null)
                {
                    loginListener.onValidateLogin(token, username, api);
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error)
            {
                Toast.makeText(context, R.string.UsernamePasswordInvalida, Toast.LENGTH_LONG).show();
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
            String token = sharedPreferences.getString(TOKEN, "");

            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET,
                    api + urlAPILeitores + queryParamAuth + token, null,new Response.Listener<JSONArray>() {
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

    public void adicionarLeitorAPI(final Leitor leitor, final Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        String api = sharedPreferences.getString(API, "");
        String token = sharedPreferences.getString(TOKEN, "");
        // Linha ↓ debaixo ↓ chamada à api
        StringRequest req = new StringRequest(Request.Method.POST, api + urlAPILeitoresCreate + queryParamAuth + token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                if(leitoresListener != null){
                    leitoresListener.onRefreshDetalhes();
                    Leitor l = LeitoresJsonParser.parserJsonLeitor(response);
                    onUpdateListaLeitoresBD(l,ADICIONAR_BD);
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String,String> params=new HashMap<>();
                params.put("nome",leitor.getNome());
                params.put("username", leitor.getUsername());
                params.put("codBarras",leitor.getCodBarras());
                params.put("nif",leitor.getNif()+"");
                params.put("docId",leitor.getDocId());
                params.put("dataNasc",leitor.getDataNasc());
                params.put("morada",leitor.getMorada());
                params.put("localidade",leitor.getLocalidade());
                params.put("codPostal",leitor.getCodPostal()+"");
                params.put("telemovel",leitor.getTelemovel()+"");
                params.put("telefone",leitor.getTelefone()+"");
                params.put("email",leitor.getEmail());
                params.put("mail2",leitor.getMail2());
                params.put("dataRegisto",leitor.getDataRegisto());
                params.put("dataAtualizado",leitor.getDataAtualizado());
                params.put("Biblioteca_id",leitor.getBiblioteca_id()+"");
                params.put("TipoLeitor_id",leitor.getTipoLeitor_Id()+"");
                return params;
            }
        };
        volleyQueue.add(req);
    }

    public void editarLeitorAPI(final Leitor leitor, final Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        String api = sharedPreferences.getString(API, "");
        String token = sharedPreferences.getString(TOKEN, "");
        StringRequest req = new StringRequest(Request.Method.PUT, api + urlAPILeitoresEdit + '/' + leitor.getId() + queryParamAuth + token, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Leitor l=LeitoresJsonParser.parserJsonLeitor(response);
                onUpdateListaLeitoresBD(l,EDITAR_BD);

                if(leitoresListener != null){
                    leitoresListener.onRefreshDetalhes();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String,String> params=new HashMap<>();
                params.put("nome",leitor.getNome());
                params.put("username", leitor.getUsername());
                params.put("codBarras",leitor.getCodBarras());
                params.put("nif",leitor.getNif()+"");
                params.put("docId",leitor.getDocId());
                params.put("dataNasc",leitor.getDataNasc());
                params.put("morada",leitor.getMorada());
                params.put("localidade",leitor.getLocalidade());
                params.put("codPostal",leitor.getCodPostal()+"");
                params.put("telemovel",leitor.getTelemovel()+"");
                params.put("telefone",leitor.getTelefone()+"");
                params.put("email",leitor.getEmail());
                params.put("mail2",leitor.getMail2());
                params.put("dataRegisto",leitor.getDataRegisto());
                params.put("dataAtualizado",leitor.getDataAtualizado());
                params.put("Biblioteca_id",leitor.getBiblioteca_id()+"");
                params.put("TipoLeitor_id",leitor.getTipoLeitor_Id()+"");
                return params;
            }
        };
        volleyQueue.add(req);
    }

    public void removerLeitorAPI(final Leitor leitor, final Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        String api = sharedPreferences.getString(API, "");
        String token = sharedPreferences.getString(TOKEN, "");
        StringRequest req = new StringRequest(Request.Method.DELETE, urlAPILeitoresDelete + '/' + leitor.getId(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                onUpdateListaLeitoresBD(leitor,REMOVER_BD);

                if(leitoresListener != null){
                    leitoresListener.onRefreshDetalhes();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });
        volleyQueue.add(req);
    }

    private void onUpdateListaLeitoresBD( Leitor leitor, int operacao){
        switch (operacao){
            case ADICIONAR_BD:
                adicionarLeitorBD(leitor);
                break;
            case EDITAR_BD:
                editarLeitorBD(leitor);
                break;
            case REMOVER_BD:
                removerLeitorBD(leitor.getId());
                break;
        }
    }
    //endregion

    //region API users
    /*public void getAllUsersAPI(final Context context){
        if(!UserJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if( usersListener != null){
                usersListener.onRefreshListaUsers(saramagoBD.getAllUsersBD());
            }
        }else{
            SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
            String api = sharedPreferences.getString(API, "");
            String token = sharedPreferences.getString(TOKEN, "");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET,
                    api + urlAPIUsers + queryParamAuth + token, null, new Response.Listener<JSONArray>() {
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
    }*/
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
            String token = sharedPreferences.getString(TOKEN, "");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET,
                    api + urlAPIObras + queryParamAuth + token, null, new Response.Listener<JSONArray>() {
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

    public void adicionarObraAPI(final Obra obra, final Context context) {
        SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
        String api = sharedPreferences.getString(API, "");
        // Linha ↓ debaixo ↓ chamada à api
        StringRequest req = new StringRequest(Request.Method.POST, api + urlAPIObrasCreate, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Obra ob = ObrasJsonParser.parserJsonObra(response);
                onUpdateListaObrasBD(ob,ADICIONAR_BD);

                if(obrasListener != null){
                    obrasListener.onRefreshDetalhes();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String,String> params=new HashMap<>();
                params.put("imgCapa",obra.getImgCapa());
                params.put("titulo",obra.getTitulo());
                params.put("resumo",obra.getResumo());
                params.put("editor",obra.getEditor());
                params.put("ano",obra.getAno()+"");
                params.put("tipoObra",obra.getTipoObra());
                params.put("descricao",obra.getDescricao());
                params.put("local",obra.getLocal());
                params.put("edicao",obra.getEdicao());
                params.put("assuntos",obra.getAssuntos());
                params.put("preco",obra.getPreco()+"");
                params.put("dataRegisto",obra.getDataRegisto());
                params.put("dataAtualizado",obra.getDataAtualizado());
                params.put("Cdu_id",obra.getCdu_id()+"");
                params.put("Colecao_id",obra.getColecao_id()+"");
                return params;
            }
        };
        volleyQueue.add(req);
    }

    private void onUpdateListaObrasBD( Obra obra, int operacao){
        switch (operacao){
            case ADICIONAR_BD:
                adicionarObraBD(obra);
                break;
            case EDITAR_BD:
                editarObraBD(obra);
                break;
            case REMOVER_BD:
                removerObraBD(obra.getId());
                break;
        }
    }

    //endregion

    //region API config

    public void getConfigAPI(final Context context){
        if(!ConfigJsonParser.isConnectionInternet(context)){
            Toast.makeText(context, R.string.semInternet, Toast.LENGTH_LONG).show();

            if(configListener != null){
                configListener.onRefreshConfig(saramagoBD.getAllConfigBD());
            }
        }else{
            SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
            String api = sharedPreferences.getString(API, "");
            String token = sharedPreferences.getString(TOKEN, "");
            JsonArrayRequest request = new JsonArrayRequest(Request.Method.GET,
                    api + urlAPIConfig + queryParamAuth + token, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    config = ConfigJsonParser.parserJsonConfig(response);
                    adicionarConfigsBD(config);

                    if (configListener != null) {
                        configListener.onRefreshConfig(config);
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


