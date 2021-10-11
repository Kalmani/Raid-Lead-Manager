'use strict';

const Home = () => {
  const character        = {
    professions : [],
    last_loots  : []
  };
  const guild_characters = [];

  return (
    <React.Fragment>
      <div class="panel panel-default">
        <div class="panel-heading" style={{padding : '7px 15px'}}>
          {character.pseudo}
          <div class="dropdown pull-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">$Home.Profile.OtherProfile; <b class="caret"> </b></a>
            <ul class="dropdown-menu" role="menu">
              {guild_characters.map((char) => (<li><a href="javascript:void(0);">{char.pseudo}</a></li>))}
            </ul>
          </div>
        </div>
        <div class="panel-body">
          <div class="row nomargin" style={{marginBottom : '10px'}}>
            <div class="col-md-12 nopadding">
              <div class="class_wow">
                <img class="img-circle" src={`http://eu.media.blizzard.com/wow/icons/36/${character.classe_icon}.jpg`} />
                {character.classe} {character.activ_spe}
              </div>
            </div>
          </div>
          <div class="row nomargin">
            <div class="col-lg-6 col-md-12 nopadding">
              <img src="{{character.profil_img}}" class="img-rounded main_profil_img" width="90%" />
            </div>
            <div class="col-lg-6 col-md-12 nopadding">
              <table class="table table-striped table-condensed">
                <tr>
                  <td>
                    $Home.Profile.Ilvl;
                  </td>
                  <td>
                    <span style={{color : '#FFD200', fontWeight : 'bold'}}>{character.ilvl}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    $Home.Profile.Wish_ilvl;
                  </td>
                  <td>
                    <span style={{color : '#FFD200', fontWeight : 'bold'}}>{character.wish_ilvl}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    $Home.Profile.Accomplishment;
                  </td>
                  <td>
                    <span style={{color : '#FFD200', fontWeight : 'bold'}}>{character.accomplished_purcent}%</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    $Home.Profile.Loots_by_raid;
                  </td>
                  <td>
                    <span style={{color : '#FFD200', fontWeight : 'bold'}}>{character.loots_by_raid}</span>
                  </td>
                </tr>
              </table>
            </div>
          </div>
          <div class="row nomargin">
            <div class="col-md-12 nopadding">
              <table class="table table-striped table-condensed">
                <thead>
                <tr>
                  <th colspan="2">
                    $Home.Profile.Profession;
                  </th>
                </tr>
                </thead>
                <tbody>
                  {character.professions.map((prof) => (
                    <tr>
                      <td>
                        <span style={{color : '#FFD200'}}>{prof.name}</span>
                      </td>
                      <td style={{fontWeight : 'bold'}}>
                        {prof.level}/{prof.max}
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
              <table class="table table-striped table-condensed">
                <thead>
                <tr>
                  <th colspan="2">
                    $Home.Profile.Last_loots;
                  </th>
                </tr>
                </thead>
                <tbody>
                  {character.last_loots.map((lloot) => (
                    <tr>
                      <td>
                        {lloot.name} ({lloot.level})
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

module.exports = Home;
