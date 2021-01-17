package com.example.saramago.adaptadores.catalogo;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.saramago.R;
import com.example.saramago.modelos.Obra;

import java.util.ArrayList;

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
        private ImageView imgIconObra;

        public ViewHolderLista(View view)
        {
            tv_titulo_obra = view.findViewById(R.id.tv_titulo_obra);
            tv_tipo_obra = view.findViewById(R.id.tv_tipo_obra);
            imgIconObra = view.findViewById(R.id.imgIconObra);

        }

        public void update(Obra obra)
        {
            tv_titulo_obra.setText(obra.getTitulo()+"");
            tv_tipo_obra.setText(obra.getTipoObra()+"");
            imgIconObra.setImageResource(R.drawable.ic_undraw_books);
        }
    }
}
