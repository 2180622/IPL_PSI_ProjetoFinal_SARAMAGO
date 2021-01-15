package com.example.saramago.adaptadores.catalogo;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.modelos.Obra;

import java.util.ArrayList;

public class ListaCatalogoAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Obra> obras;

    public ListaCatalogoAdaptador(Context context, ArrayList<Leitor> leitores) {
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
            //convertView=inflater.inflate(R.layout.item_lista_obras, null);
        }

        //otimização
        ViewHolderLista viewHolder = (ViewHolderLista)convertView.getTag();
        if(viewHolder==null)
        {
            viewHolder = new ViewHolderLista(convertView);
            convertView.setTag(viewHolder);
        }

        //viewHolder.update(obras.get(position)); //manda a posição e devolve a obra

        return convertView;
    }

    private class ViewHolderLista
    {
        private TextView tv_nome_leitor, tv_tipo_leitor;
        private ImageView imgIconLeitor;

        public ViewHolderLista(View view)
        {
            tv_nome_leitor = view.findViewById(R.id.tv_nome_leitor);
            tv_tipo_leitor = view.findViewById(R.id.tv_tipo_leitor);
            imgIconLeitor = view.findViewById(R.id.imgIconLeitor);

        }

        public void update(Leitor leitor)
        {
            //tv_nome_leitor.setText(obras.getNome());
            tv_tipo_leitor.setText(leitor.getTipoLeitor_Id()+"");
            imgIconLeitor.setImageResource(R.drawable.ic_undraw_male_avatar);
        }
    }
}
