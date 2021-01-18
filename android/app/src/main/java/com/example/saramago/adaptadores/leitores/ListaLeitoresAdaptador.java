package com.example.saramago.adaptadores.leitores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;

import java.util.ArrayList;

public class ListaLeitoresAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Leitor> leitores;

    public ListaLeitoresAdaptador(Context context, ArrayList<Leitor> leitores) {
        this.context = context;
        this.leitores = leitores;
    }

    @Override
    public int getCount() {
        return leitores.size();
    }

    @Override
    public Object getItem(int position) {
        return leitores.get(position);
    }

    @Override
    public long getItemId(int position) {
        return leitores.get(position).getId();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater==null)
        {
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if(convertView==null)
        {
            convertView=inflater.inflate(R.layout.item_lista_leitores, null);
        }

        //otimização
        ViewHolderLista viewHolder = (ViewHolderLista)convertView.getTag();
        if(viewHolder==null)
        {
            viewHolder = new ViewHolderLista(convertView);
            convertView.setTag(viewHolder);
        }

        viewHolder.update(leitores.get(position)); //manda a posição e devolve o leitor

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
            tv_nome_leitor.setText(leitor.getNome());
            tv_tipo_leitor.setText(R.string.aluno);
            imgIconLeitor.setImageResource(R.drawable.ic_undraw_male_avatar);
        }
    }
}
