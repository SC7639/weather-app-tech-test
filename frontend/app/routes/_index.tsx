import type { V2_MetaFunction } from "@remix-run/node";
import { useEffect, useState } from "react";
import Location from "~/components/Location";
import Weather from "~/components/Weather";

export interface WeatherData {
  timestamp: string;
  hoursAhead: number;
  temperature: number;
}

export const meta: V2_MetaFunction = () => {
  return [
    { title: "Weather App" },
    { name: "description", content: "Welcome weather app" },
  ];
};

export default function Index() {
  const [weatherData, setWeatherData] = useState<WeatherData[]>();
  const [isFetchingWeatherData, setIsFetchingWeatherData] =
    useState<boolean>(false);

  return (
    <div
      style={{
        fontFamily: "system-ui, sans-serif",
        lineHeight: "1.8",
      }}
    >
      <h1 className="text-3xl font-bold">Weather App</h1>

      <Location
        setWeatherData={setWeatherData}
        isFetchingWeatherData={isFetchingWeatherData}
        setIsFetchingWeatherData={setIsFetchingWeatherData}
      />

      <Weather weatherData={weatherData} />
    </div>
  );
}
