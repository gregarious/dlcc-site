import json
import MySQLdb

def main():
    conn = MySQLdb.connect(user='root', db='dlcc')
    cur = conn.cursor()

    with open('data.json') as f:
        data = json.load(f)

    type_obj_map = {}
    for obj in data:
        type_obj_map.setdefault(obj['category'], []).append(obj)

    for restaurant in type_obj_map['restaurant']:
        cur.execute(
            '''INSERT INTO restaurant (name, address, lat, lng, price, type)
                VALUES (%s, %s, %s, %s, %s, %s)''', (
            restaurant.get('name', ''),
            restaurant.get('address', ''),
            (restaurant.get('location') or {}).get('lat'),
            (restaurant.get('location') or {}).get('lng'),
            restaurant.get('price', ''),
            restaurant.get('type', ''),
        ))


    for attraction in type_obj_map['attraction']:
        cur.execute(
            '''INSERT INTO attraction (name, address, lat, lng, phone, website)
                VALUES (%s, %s, %s, %s, %s, %s)''', (
            attraction.get('name', ''),
            attraction.get('address', ''),
            (attraction.get('location') or {}).get('lat'),
            (attraction.get('location') or {}).get('lng'),
            attraction.get('phone', ''),
            attraction.get('website', ''),
        ))

    for hotel in type_obj_map['hotel']:
        cur.execute(
            '''INSERT INTO hotel (name, address, lat, lng, phone)
                VALUES (%s, %s, %s, %s, %s)''', (
            hotel.get('name', ''),
            hotel.get('address', ''),
            (hotel.get('location') or {}).get('lat'),
            (hotel.get('location') or {}).get('lng'),
            hotel.get('phone', ''),
        ))

    for parking in type_obj_map['parking']:
        cur.execute(
            '''INSERT INTO parking (name, address, lat, lng, rates)
                VALUES (%s, %s, %s, %s, %s)''', (
            parking.get('name', ''),
            parking.get('address', ''),
            (parking.get('location') or {}).get('lat'),
            (parking.get('location') or {}).get('lng'),
            parking.get('rates', ''),
        ))
    conn.commit()

    cur.close()
    conn.close()

if __name__ == '__main__':
    main()
