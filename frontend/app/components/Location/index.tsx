import { WeatherData } from "~/routes/_index";
import MapPin from "../MapPin";
import { FC } from "react";
import LoadingSpinner from "../LoadingSpinner";

interface LocationProps {
  setWeatherData: React.Dispatch<
    React.SetStateAction<WeatherData[] | undefined>
  >;
  isFetchingWeatherData: boolean;
  setIsFetchingWeatherData: React.Dispatch<React.SetStateAction<boolean>>;
}

const fetchWeatherData = async (
  lat: number,
  long: number
): Promise<WeatherData[] | undefined> => {
  try {
    const searchParams = new URLSearchParams({
      lat: lat.toString(),
      long: long.toString(),
    });
    const resp = await fetch(
      `http://localhost/api/weather/latest?${searchParams}`
    );

    if (!resp.ok) {
      throw new Error("Failed to get weather data");
    }

    const { data } = await resp.json();
    return data as WeatherData[];
  } catch (err) {
    console.error(err);
  }
};

const Location: FC<LocationProps> = ({
  setWeatherData,
  isFetchingWeatherData,
  setIsFetchingWeatherData,
}) => {
  const handleGetLocationClick = () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        async (position) => {
          if (isFetchingWeatherData) {
            return;
          }

          const { latitude, longitude } = position.coords;
          setIsFetchingWeatherData(true);
          const data = await fetchWeatherData(latitude, longitude);
          setIsFetchingWeatherData(false);

          if (data) {
            setWeatherData(data);
          }
        },
        (err) => {
          console.error(err);
        }
      );
    }
  };

  return (
    <div className="mt-4">
      <button
        className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded pr-6"
        onClick={handleGetLocationClick}
        disabled={isFetchingWeatherData}
      >
        {isFetchingWeatherData ? (
          <>
            <LoadingSpinner />
            Fetching weather data
          </>
        ) : (
          <>
            <MapPin /> Weather near me
          </>
        )}
      </button>
    </div>
  );
};

export default Location;
