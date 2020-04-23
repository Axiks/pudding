// 1
import gql from 'graphql-tag';
export const CREATE_CLUB_MUTATION = gql`
  # 1
  mutation createClub($name: String!, $description: String!, $cover_src: String, $creator_id: String!) {
    createClub(
      name: $name,
      description: $description,
      cover_src: $cover_src,
      creator_id: $creator_id,
    ) {
      id
      name
      description
    }
  }
`
export const ALL_CLUBS_QUERY = gql`
  # 2
  query AllClubsQuery {
    clubs{
      id,
      name,
      description,
      avatar_src,
      cover_src
    }
  }
`

export const UPLOAD_FILES_MUTATION = gql`
  #3
  mutation ($file: Upload!, $id: ID!) {
    uploadAvatarClub(
      file: $file,
      id: $id
    )
  }
`

export const UPLOAD_COVER_CLUB_MUTATION = gql`
  #3
  mutation ($file: Upload!, $id: ID!) {
    uploadCoverClub(
      file: $file,
      id: $id
    )
  }
`

export const DESTROY_AVATAR_CLUB_MUTATION = gql`
  #4
  mutation ($id: ID!) {
    destroyAvatarClub(
      id: $id
    )
  }
`
export const DESTROY_CLUB_MUTATION = gql`
  #4
  mutation ($id: ID!) {
    deleteClub(
      id: $id
    ){
      id
    }
  }
`

export const CLUB_QUERY = gql`
  # 5
  query club($id: Int!) {
    club(id: $id) {
      id,
      name,
      description,
      avatar_src,
      cover_src,
      meets{
        id,
        title,
        description,
        beginning_date,
        map_point,
        end_date,
        user_id,
      }
    }
  }
`

export const CREATE_MEET_MUTATION = gql`
  # 6
  mutation createMeet($title: String!, $description: String!, $beginning_date: DateTime!, $end_date: DateTime!, $map_point: String!, $club_id: String!, $user_id: String!) {
    createMeet(
      title: $title,
      description: $description,
      beginning_date: $beginning_date,
      end_date: $end_date,
      map_point: $map_point,
      club_id: $club_id,
      user_id: $user_id,
    ) {
      id
      title
      description
    }
  }
`

export const MEET_QUERY = gql`
  # 7
  query meet($id: Int!) {
    meet(id: $id) {
      id,
      club_id,
      user_id,
      title,
      description,
      beginning_date,
      end_date,
      map_point,
      club{
        id,
        name,
        description,
      },
      user{
        id,
        name,
        email
      }
    }
  }
`

export const CREATE_USER_MUTATION = gql`
  # 8
  mutation register($name: String!, $surname: String!, $email: String!, $password: String!, $password_confirmation: String!, $birthday: String!) {
      register(
        input: {
        name: $name,
        surname: $surname,
        email: $email,
        password: $password,
        password_confirmation: $password_confirmation,
        birthday: $birthday,
        }
      ) {
        tokens{
          access_token
          token_type
        }
      }
  }
`

export const USER_QUERY = gql`
  # 9
  query GetUser($id: ID!){
    user(id: $id){
      id,
      name,
      surname,
      birthday,
      description,
      avatar_src,
      created_at
    }
  }
`

export const EMAIL_CHECK = gql`
  # 10
  query EmailCheck($email: String!){
    Check_email(email: $email)
  }
`

export const USER_LOGIN = gql`
# 11
mutation login($email: String!, $password: String!) {
    login(
      input: {
      username: $email,
      password: $password,
      }
    ) {
      access_token
      token_type
    }
}
`

export const ME_DATA_QUERY = gql`
  # 12
  query AllMeQuery {
    me{
      id,
      name,
      surname,
      birthday,
      description,
      avatar_src,
      created_at,
      email
    }
  }
`