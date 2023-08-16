import moment from "moment";
import { FC } from "react";
import { WeatherData } from "~/routes/_index";

interface WeatherProps {
  weatherData: WeatherData[] | undefined;
}

const Weather: FC<WeatherProps> = ({ weatherData }) => {
  if (!weatherData) {
    return null;
  }

  return (
    <div className="mt-4 w-96">
      {weatherData.map((weather) => (
        <div className="grid grid-cols-2 gap-1">
          <div>
            {moment(weather.timestamp)
              .add(weather.hoursAhead, "hours")
              .format("Do MMMM, h:mm a")}
          </div>
          <div>{weather.temperature} C</div>
        </div>
      ))}
    </div>
  );
};

export default Weather;
