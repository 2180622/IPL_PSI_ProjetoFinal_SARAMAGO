package com.example.saramago.adaptadores.catalogo;

import android.content.Context;
import android.content.SharedPreferences;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.saramago.R;
import com.example.saramago.modelos.Obra;
import com.example.saramago.vistas.MenuMainActivity;

import java.util.ArrayList;

import static com.example.saramago.vistas.MenuMainActivity.API;

public class ListaObrasAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Obra> obras;

    public ListaObrasAdaptador(Context context, ArrayList<Obra> obras) {
        this.context = context;
        this.obras = obras;
    }

    @Override
    public int getCount() {
        return obras.size();
    }

    @Override
    public Object getItem(int position) {
        return obras.get(position);
    }

    @Override
    public long getItemId(int position) {
        return obras.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater==null)
        {
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if(convertView==null)
        {
            convertView=inflater.inflate(R.layout.item_lista_obras, null);
        }

        //otimização
        ViewHolderLista viewHolder = (ViewHolderLista)convertView.getTag();
        if(viewHolder==null)
        {
            viewHolder = new ViewHolderLista(convertView);
            convertView.setTag(viewHolder);
        }

        viewHolder.update(obras.get(position)); //manda a posição e devolve a obra

        return convertView;
    }

    private class ViewHolderLista
    {
        private TextView tv_titulo_obra, tv_tipo_obra;
        private ImageView iv_imgCapa;

        public ViewHolderLista(View view)
        {
            tv_titulo_obra = view.findViewById(R.id.tv_titulo_obra);
            tv_tipo_obra = view.findViewById(R.id.tv_tipo_obra);
            iv_imgCapa = view.findViewById(R.id.imgCapa);

        }

        public void update(Obra obra)
        {
            SharedPreferences sharedPreferences = context.getSharedPreferences(MenuMainActivity.PREF_INFO_USER, Context.MODE_PRIVATE);
            String api = sharedPreferences.getString(API, "");
            tv_titulo_obra.setText(obra.getTitulo()+"");
            if (obra.getTipoObra().equals("pubPeriodica")) {
                tv_tipo_obra.setText("Publicação periódica");
            }
            else if (obra.getTipoObra().equals("materialAv")) {
                tv_tipo_obra.setText("Material audiovisual");
            }
            else {
                tv_tipo_obra.setText("Monografia");
            }
            Glide.with(context)
                    .load(api+"/img/"+obra.getImgCapa())
                    .placeholder(R.drawable.ic_undraw_books)
                    .diskCacheStrategy(DiskCacheStrategy.NONE)
                    .fitCenter().into(iv_imgCapa);
        }
    }
}
