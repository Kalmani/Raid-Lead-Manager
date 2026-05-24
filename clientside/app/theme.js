import {alpha, createTheme} from '@mui/material/styles';

const colors = {
  gold : '#e4bf73',
  goldBright : '#f6dfaa',
  brass : '#a8712a',
  blue : '#78a8d8',
  blueBright : '#bad9ff',
  ink : '#060912',
  midnight : '#0b1220',
  panel : '#101826',
  panelSoft : '#152033',
  text : '#f6efe2',
  subtext : '#afbbc9'
};

const theme = createTheme({
  palette : {
    mode : 'dark',
    primary : {
      main : colors.gold,
      light : colors.goldBright,
      dark : colors.brass
    },
    secondary : {
      main : colors.blue,
      light : colors.blueBright
    },
    background : {
      default : colors.ink,
      paper : alpha(colors.panel, 0.86)
    },
    success : {
      main : '#85c58f'
    },
    warning : {
      main : '#f5b869'
    },
    error : {
      main : '#f38a8a'
    },
    text : {
      primary : colors.text,
      secondary : colors.subtext
    },
    divider : alpha(colors.gold, 0.12)
  },
  shape : {
    borderRadius : 5
  },
  typography : {
    fontFamily : '"Trebuchet MS", "Gill Sans", "Segoe UI", sans-serif',
    h1 : {
      fontFamily : '"Palatino Linotype", Georgia, serif',
      fontWeight : 700,
      letterSpacing : '-0.03em'
    },
    h2 : {
      fontFamily : '"Palatino Linotype", Georgia, serif',
      fontWeight : 700,
      letterSpacing : '-0.03em'
    },
    h3 : {
      fontFamily : '"Palatino Linotype", Georgia, serif',
      fontWeight : 700,
      letterSpacing : '-0.03em'
    },
    h4 : {
      fontFamily : '"Palatino Linotype", Georgia, serif',
      fontWeight : 700,
      letterSpacing : '-0.03em'
    },
    h5 : {
      fontFamily : '"Palatino Linotype", Georgia, serif',
      fontWeight : 700
    },
    button : {
      letterSpacing : '0.02em'
    }
  },
  components : {
    MuiCssBaseline : {
      styleOverrides : {
        ':root' : {
          colorScheme : 'dark'
        },
        '@keyframes floatAura' : {
          '0%' : {
            transform : 'translate3d(0, 0, 0) scale(1)'
          },
          '50%' : {
            transform : 'translate3d(0, -12px, 0) scale(1.03)'
          },
          '100%' : {
            transform : 'translate3d(0, 0, 0) scale(1)'
          }
        },
        '@keyframes panelReveal' : {
          from : {
            opacity : 0,
            transform : 'translate3d(0, 18px, 0)'
          },
          to : {
            opacity : 1,
            transform : 'translate3d(0, 0, 0)'
          }
        },
        'html, body, #root' : {
          minHeight : '100%'
        },
        body : {
          margin : 0,
          backgroundColor : colors.ink,
          backgroundImage : [
            'radial-gradient(circle at 8% 12%, rgba(228, 191, 115, 0.18), transparent 26%)',
            'radial-gradient(circle at 88% 14%, rgba(120, 168, 216, 0.16), transparent 24%)',
            'radial-gradient(circle at 50% 100%, rgba(228, 191, 115, 0.08), transparent 34%)',
            'linear-gradient(160deg, rgba(6, 9, 18, 0.98), rgba(11, 18, 32, 0.96) 42%, rgba(8, 12, 20, 0.99))',
            'url("./theme/rsc/background-v2.gif")'
          ].join(', '),
          backgroundAttachment : 'fixed',
          backgroundSize : 'auto, auto, auto, auto, cover'
        },
        'body::before' : {
          content : '""',
          position : 'fixed',
          inset : 0,
          pointerEvents : 'none',
          backgroundImage : [
            'linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px)',
            'linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px)'
          ].join(', '),
          backgroundSize : '120px 120px',
          maskImage : 'linear-gradient(180deg, rgba(0,0,0,0.28), rgba(0,0,0,0.04) 45%, rgba(0,0,0,0.28))',
          opacity : 0.18
        },
        'body::after' : {
          content : '""',
          position : 'fixed',
          inset : '-10%',
          pointerEvents : 'none',
          background : 'radial-gradient(circle at center, transparent 48%, rgba(0, 0, 0, 0.54) 100%)',
          animation : 'floatAura 16s ease-in-out infinite'
        },
        img : {
          display : 'block',
          maxWidth : '100%'
        },
        a : {
          color : 'inherit'
        },
        '::selection' : {
          backgroundColor : alpha(colors.gold, 0.32),
          color : colors.text
        },
        '*::-webkit-scrollbar' : {
          width : 10,
          height : 10
        },
        '*::-webkit-scrollbar-thumb' : {
          background : `linear-gradient(180deg, ${alpha(colors.gold, 0.65)}, ${alpha(colors.blue, 0.5)})`,
          borderRadius : 999,
          border : '2px solid transparent',
          backgroundClip : 'padding-box'
        },
        '*::-webkit-scrollbar-track' : {
          background : alpha(colors.panelSoft, 0.28)
        }
      }
    },
    MuiPaper : {
      styleOverrides : {
        root : {
          position : 'relative',
          overflow : 'hidden',
          backgroundImage : `linear-gradient(180deg, ${alpha('#ffffff', 0.045)}, transparent 28%), linear-gradient(145deg, ${alpha(colors.panelSoft, 0.9)}, ${alpha(colors.midnight, 0.84)})`,
          border : `1px solid ${alpha(colors.gold, 0.12)}`,
          boxShadow : '0 24px 80px rgba(0, 0, 0, 0.42)',
          backdropFilter : 'blur(20px)',
          animation : 'panelReveal 420ms ease',
          '&::before' : {
            content : '""',
            position : 'absolute',
            inset : 0,
            pointerEvents : 'none',
            background : 'linear-gradient(120deg, rgba(255,255,255,0.08), transparent 22%, transparent 76%, rgba(120,168,216,0.07))',
            opacity : 0.7
          }
        }
      }
    },
    MuiCard : {
      styleOverrides : {
        root : {
          backgroundColor : alpha(colors.panel, 0.88),
          transition : 'box-shadow 180ms ease, border-color 180ms ease',
          '&:hover' : {
            boxShadow : '0 26px 82px rgba(0, 0, 0, 0.45)',
            borderColor : alpha(colors.goldBright, 0.18)
          }
        }
      }
    },
    MuiCardHeader : {
      styleOverrides : {
        root : {
          paddingBottom : 12
        },
        title : {
          lineHeight : 1.15
        },
        subheader : {
          marginTop : 4
        }
      }
    },
    MuiButton : {
      defaultProps : {
        disableElevation : true
      },
      styleOverrides : {
        root : {
          borderRadius : 12,
          textTransform : 'none',
          fontWeight : 700,
          transition : 'transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease, background-color 180ms ease'
        },
        contained : {
          backgroundImage : `linear-gradient(135deg, ${colors.goldBright}, ${colors.gold})`,
          color : '#241708',
          boxShadow : '0 16px 34px rgba(228, 191, 115, 0.24)',
          '&:hover' : {
            transform : 'translateY(-2px)',
            boxShadow : '0 20px 40px rgba(228, 191, 115, 0.3)'
          }
        },
        outlined : {
          borderColor : alpha(colors.gold, 0.18),
          backgroundColor : alpha(colors.panelSoft, 0.32),
          '&:hover' : {
            transform : 'translateY(-2px)',
            borderColor : alpha(colors.goldBright, 0.34),
            backgroundColor : alpha(colors.gold, 0.08)
          }
        }
      }
    },
    MuiChip : {
      styleOverrides : {
        root : {
          borderRadius : 999,
          fontWeight : 700,
          backgroundColor : alpha(colors.panelSoft, 0.82),
          border : `1px solid ${alpha(colors.gold, 0.14)}`,
          backdropFilter : 'blur(12px)'
        }
      }
    },
    MuiListItemButton : {
      styleOverrides : {
        root : {
          borderRadius : 12,
          marginBottom : 8,
          transition : 'transform 160ms ease, border-color 160ms ease, background-color 160ms ease',
          '&:hover' : {
            transform : 'translateX(4px)'
          }
        }
      }
    },
    MuiAlert : {
      styleOverrides : {
        root : {
          borderRadius : 12,
          boxShadow : '0 18px 48px rgba(0, 0, 0, 0.28)'
        }
      }
    },
    MuiTextField : {
      defaultProps : {
        fullWidth : true,
        size : 'medium'
      }
    },
    MuiOutlinedInput : {
      styleOverrides : {
        root : {
          backgroundColor : alpha(colors.panelSoft, 0.58),
          borderRadius : 12,
          transition : 'box-shadow 180ms ease, background-color 180ms ease',
          '&:hover' : {
            backgroundColor : alpha(colors.panelSoft, 0.72)
          },
          '&.Mui-focused' : {
            boxShadow : `0 0 0 4px ${alpha(colors.gold, 0.12)}`
          }
        },
        notchedOutline : {
          borderColor : alpha(colors.gold, 0.16)
        }
      }
    }
  }
});

export default theme;
