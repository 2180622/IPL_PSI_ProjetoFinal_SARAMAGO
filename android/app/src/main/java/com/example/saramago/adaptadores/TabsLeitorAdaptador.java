package com.example.saramago.adaptadores;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentActivity;
import androidx.viewpager2.adapter.FragmentStateAdapter;

import com.example.saramago.vistas.tabs.EmprestimosLeitorFragment;
import com.example.saramago.vistas.tabs.FichaLeitorFragment;
import com.example.saramago.vistas.tabs.ReprografiaLeitoresFragment;
import com.example.saramago.vistas.tabs.ReservasLeitorFragment;

// RETIRADO DE: https://www.youtube.com/watch?v=ajVVjuOSlV4&ab_channel=ChiragKachhadiya
public class TabsLeitorAdaptador extends FragmentStateAdapter {

    public TabsLeitorAdaptador(@NonNull FragmentActivity fragmentActivity) {
        super(fragmentActivity);
    }

    @NonNull
    @Override
    public Fragment createFragment(int position) {
        switch (position){
            case 0:
                return new FichaLeitorFragment();
            case 1:
                return new EmprestimosLeitorFragment();
            case 2:
                return new ReservasLeitorFragment();
            default:
                return new ReprografiaLeitoresFragment();
        }
    }

    @Override
    public int getItemCount() {
        return 4;
    }
}
