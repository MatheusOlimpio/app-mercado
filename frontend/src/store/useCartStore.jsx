import toast from "react-hot-toast";
import { create } from "zustand";

export const useCartStore = create((set, get) => ({
  cart: [],

  totalItems: () => {
    const { cart } = get();
    const total = cart.reduce((a, b) => a + b.quantidade, 0) ?? 0;
    return total;
  },
  totalPrice: () => {
    const { cart } = get();
    return cart
      .map((item) => item.quantidade * item.valor)
      .reduce((a, b) => a + b, 0);
  },
  addItem: (newItem) =>
    set((state) => {
      const newCart = addCartItem(newItem, state.cart);
      toast.success("Item adicionado ao carrinho");
      return { cart: newCart };
    }),
  removeItem: (productId) =>
    set((state) => {
      const newCart = removeItem(productId, state.cart);
      toast.success("Item removido do carrinho");

      return { cart: newCart };
    }),
  removeAllItems: () => set({ cart: [] }),
}));

function addCartItem({ id, nome, valor }, cart) {
  const amount = 1;

  const sameItemOnCartById = cart.map((item) => item.id).includes(id);

  if (!sameItemOnCartById) {
    return [
      ...cart,
      { id, nome, valor, quantidade: amount, valorTotal: valor },
    ];
  }

  return cart.map((item) => {
    if (item.id === id) {
      return {
        ...item,
        quantidade: item.quantidade + 1,
        valorTotal: (item.quantidade + 1) * item.valor,
      };
    }
    return item;
  });
}

const removeItem = (productId, cart) => {
  if (cart.length === 0) return;

  return cart.filter((item) => item.id !== productId);
};
