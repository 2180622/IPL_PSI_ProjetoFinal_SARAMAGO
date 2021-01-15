package com.example.saramago.adaptadores.catalogo;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.viewpager2.adapter.FragmentStateAdapter;

import com.example.saramago.vistas.catalogo.tabs.FichaObraFragment;
import com.example.saramago.vistas.catalogo.tabs.ListaExemplarFragment;

public class TabsCatalogoAdaptador extends FragmentStateAdapter {

    public TabsCatalogoAdaptador(@NonNull FragmentActivity fragmentActivity) {
        super(fragmentActivity);
    }

    @NonNull
    @Override
    public Fragment createFragment(int position) {
        switch (position){
            case 0:
                return new FichaObraFragment();
            case 1:
                return new ListaExemplarFragment();
            default:
                return new FichaObraFragment();
        }
    }

    @Override
    public int getItemCount() {
        return 3;
    }
}
