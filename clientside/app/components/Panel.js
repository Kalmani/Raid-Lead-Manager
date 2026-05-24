import React from 'react';
import {Box, Card, CardContent, CardHeader, Divider, Typography} from '@mui/material';

function Panel({actions, children, title, subtitle}) {
  return (
    <Card
      sx={{
        backgroundImage : 'linear-gradient(180deg, rgba(255,255,255,0.04), transparent 18%), linear-gradient(145deg, rgba(17,25,39,0.92), rgba(10,14,24,0.9))'
      }}
    >
      <CardHeader
        action={actions}
        subheader={subtitle ? (
          <Typography
            color="text.secondary"
            sx={{lineHeight : 1.3, overflowWrap : 'anywhere'}}
            variant="body2"
          >
            {subtitle}
          </Typography>
        ) : null}
        title={title}
        titleTypographyProps={{
          variant : 'h5',
          sx : {
            lineHeight : 1.2,
            overflowWrap : 'anywhere'
          }
        }}
        sx={{
          position : 'relative',
          zIndex : 1,
          '& .MuiCardHeader-action' : {
            alignSelf : 'center',
            margin : 0
          }
        }}
      />
      <Box sx={{px : 3}}>
        <Divider sx={{borderColor : 'rgba(228,191,115,0.12)'}} />
      </Box>
      <CardContent sx={{pt : 2.5, position : 'relative', zIndex : 1}}>
        {children}
      </CardContent>
    </Card>
  );
}

export default Panel;
