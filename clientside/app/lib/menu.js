const MENU_GROUPS = [
  {
    title : 'Raid',
    items : [
      {path : '/home', label : 'Accueil', title : 'Accueil', description : 'Vue d’ensemble du personnage, de l’équipement et des notes de mise à jour.'},
      {path : '/settings', label : 'Paramètres', title : 'Paramètres', description : 'Identifiants, email et réglages personnels du compte.'},
      {path : '/compare', label : 'Comparateur', title : 'Comparateur', description : 'Espace réservé au comparateur de personnages et de loot.'},
      {path : '/history', label : 'Historique', title : 'Historique', description : 'Historique des attributions et de la progression de raid.'}
    ]
  },
  {
    title : 'Wish Lists',
    items : [
      {path : '/wishlist/bis', label : 'BIS', title : 'Wish List BIS', kind : 'bis', description : 'Sélection principale des meilleures pièces disponibles.'},
      {path : '/wishlist/prov', label : 'Provisoire', title : 'Wish List Provisoire', kind : 'prov', description : 'Sélection temporaire pour avancer sans attendre le BIS.'},
      {path : '/wishlist/spe2', label : 'Spé 2', title : 'Wish List Spé 2', kind : 'spe2', description : 'Sélection secondaire pour la seconde spécialisation.'}
    ]
  },
  {
    title : 'Administration',
    items : [
      {path : '/admin', label : 'Vue Admin', title : 'Administration', description : 'Porte d’entrée des outils de gestion de raid.'},
      {path : '/admin/down-bosses', label : 'Down de boss', title : 'Down de boss', description : 'Suivi de la progression des boss et de la semaine de raid.'},
      {path : '/admin/attribution', label : 'Attributions', title : 'Attributions', description : 'Gestion des attributions de loot.'},
      {path : '/admin/fix-attrib', label : 'Correctif', title : "Correctif d'attributions", description : 'Correction manuelle des erreurs d’attribution.'},
      {path : '/admin/accounts', label : 'Comptes', title : 'Gestion des comptes', description : 'Gestion des comptes de guilde et des permissions.'},
      {path : '/admin/stats', label : 'Statistiques', title : 'Statistiques', description : 'Tableaux de bord et statistiques de distribution.'},
      {path : '/admin/updates', label : 'Notes', title : 'Notes de mise à jour', description : 'Rédaction et publication des notes de mise à jour.'},
      {path : '/admin/import', label : 'Import', title : "Import d'items", description : 'Import et maintenance du catalogue d’items.'},
      {path : '/admin/missing', label : 'Objets manquants', title : 'Objets manquants', description : 'Suivi des pièces absentes du catalogue.'},
      {path : '/admin/calendar', label : 'Calendrier', title : 'Calendrier', description : 'Planning de raid et disponibilité des membres.'},
      {path : '/admin/crafts', label : 'Crafts', title : 'Liste des crafts', description : 'Suivi des crafts utiles à la progression du roster.'}
    ]
  }
];

const DEFAULT_SCREEN = {
  path : '/home',
  title : 'Raid Lead Manager',
  description : 'Réécriture React du frontend historique.'
};

export function getMenuGroups() {
  return MENU_GROUPS;
}

export function getScreenMeta(path) {
  const allItems = MENU_GROUPS.flatMap((group) => group.items);
  return allItems.find((item) => item.path === path) || DEFAULT_SCREEN;
}
