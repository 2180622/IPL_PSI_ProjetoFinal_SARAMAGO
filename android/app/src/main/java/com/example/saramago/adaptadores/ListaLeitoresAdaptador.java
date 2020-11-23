package com.example.saramago.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;

import com.example.saramago.R;
import com.example.saramago.modelos.Leitor;
import com.example.saramago.vistas.ListaLeitoresActivity;

import java.util.ArrayList;

public class ListaLeitoresAdaptador extends BaseAdapter {

    private Context context;
    private LayoutInflater layoutInflater;
    private ArrayList<Leitor> leitores;

    public ListaLeitoresAdaptador(Context context, ArrayList<Leitor> leitores) {
        this.context = context;
        //this.inflater = inflater;
        this.leitores = leitores;
    }

    @Override
    public int getCount() {
        return 0;
    }

    @Override
    public Object getItem(int position) {
        return null;
    }

    @Override
    public long getItemId(int position) {
        return 0;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(layoutInflater==null)
        {
            layoutInflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if(convertView==null)
        {
            convertView=layoutInflater.inflate(R.layout.item_lista_leitores, null);
        }

        /* otimização
        ViewHolderLista viewHolder = (ViewHolderLista)convertView.getTag();
        if(viewHolder==null)
        {
            viewHolder = new ViewHolderLista(convertView);
            convertView.setTag(viewHolder);
        }

        viewHolder.update(livros.get(position)); //manda a posição e devolve o livro*/

        return convertView;
    }
}
